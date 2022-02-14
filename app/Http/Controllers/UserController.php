<?php
namespace App\Http\Controllers;
use Gate;

use App\Http\Requests\User\AddValidation;
use App\Http\Requests\User\EditValidation;
use App\Role;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use View, AppHelper, Image, URL;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UserController extends CollegeBaseController
{
    use EntrustUserTrait;
    protected $base_route = 'user';
    protected $view_path = 'user';
    protected $panel = 'User';
    protected $folder_path;
    protected $folder_name = 'user';
    protected $filter_query = [];

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        /*Check Role and get user with role values*/
        if($request->has('role')){
            $data['rows'] = User::select('users.id', 'users.name', 'users.email', 'users.profile_image', 'users.contact_number',
                'users.address', 'users.status', 'ru.role_id')
                ->where('ru.user_id','<>',1)
                ->where(function ($query) use ($request) {

                    if ($request->has('name')) {
                        $query->where('users.name', 'like', '%'.$request->name.'%')
                            ->orWhere('users.email', 'like', '%'.$request->name.'%');
                        $this->filter_query['users.name'] = $request->name;
                    }

                    if ($request->has('role')) {
                        $query->where('ru.role_id', '=',$request->get('role'));
                        $this->filter_query['ru.role_id'] = $request->get('role');
                    }

                    if ($request->has('status')) {
                        $query->where('users.status', $request->status == 'active'?1:0);
                        $this->filter_query['users.status'] = $request->get('status');
                    }
                })
                ->join('role_user as ru','ru.user_id','=','users.id')
                ->get();
        }else{
            $data['rows'] = User::select('users.id', 'users.name', 'users.email', 'users.profile_image', 'users.contact_number',
                'users.address', 'users.status')
                ->where('users.id','<>',1)
                ->whereNotIn('r.id',[6,7])
                ->where(function ($query) use ($request) {

                    if ($request->has('name')) {
                        $query->where('users.name', 'like', '%'.$request->name.'%')
                            ->orWhere('users.email', 'like', '%'.$request->name.'%');
                        $this->filter_query['users.name'] = $request->name;
                    }

                    if ($request->has('status')) {
                        $query->where('users.status', $request->status == 'active'?1:0);
                        $this->filter_query['users.status'] = $request->get('status');
                    }
                })
                ->join('role_user as ru','ru.user_id','=','users.id')
                ->join('roles as r','r.id','=','ru.role_id')
                ->get();
        }

        $data['roles'] = [];
        $data['roles'][0] = 'Select Role';
        foreach (Role::select('id', 'display_name')->where('id','<>','1')->get() as $role) {
            $data['roles'][$role->id] = $role->display_name;
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add()
    {
        $data = [];
        $data['roles'] = Role::whereNotIn('id',[1,6,7])->get();

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        if($request->password != $request->confirmPassword){
            $request->session()->flash($this->message_warning, 'Password & Confirm Password Not Match.');
            return redirect()->back();
        }

        if ($request->hasFile('main_image')){
            $image_name = parent::uploadImages($request, 'main_image');
        }else{
            $image_name = "";
        }

        $request->request->add(['password' => bcrypt($request->get('password'))]);
        $request->request->add(['profile_image' => $image_name]);

        $user = User::create($request->all());

        $roles = [];
        if($request->get('role')){
            foreach ($request->get('role') as $role){
                $roles[$role] = [
                    'user_id' => $user->id,
                    'role_id' => $role
                ];
            }
        }

        $user->userRole()->sync($roles);

        $request->session()->flash($this->message_success, $this->panel. ' successfully added.');

        if($request->add_user_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }
    }

    public function view($id)
    {
        $id = decrypt($id);
        $data = [];
        if(auth()->user()->id == 1){
            if (!$data['row'] = User::find($id)){
                return parent::invalidRequest();
            }
        }else{
            if (!$data['row'] = User::find($id)){
                return parent::invalidRequest();
            }
        }

        $data['row'] = User::find($id);

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.view'), compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        /*Check the super admin detail authorization on edit*/
        if(auth()->user()->id == 1){
            if (!$data['row'] = User::find($id)){
                return parent::invalidRequest();
            }

            $data['roles'] = Role::all();
        }else{
            if (!$data['row'] = User::where('id','<>','1')->find($id)){
                return parent::invalidRequest();
            }

            $data['roles'] = Role::whereNotIn('id',[1,6,7])->get();
        }


        $data['active_roles'] = $data['row']->userRole()->pluck('roles.name', 'roles.id')->toArray();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        //$id = decrypt($id);
        if (!$row = User::find($id)) return parent::invalidRequest();

        if($request->password != $request->confirmPassword){
            $request->session()->flash($this->message_warning, 'Password & Confirm Password Not Match.');
            return redirect()->back();
        }

        if ($request->hasFile('main_image')) {

            $image_name = parent::uploadImages($request, 'main_image');

            // remove old image from folder
            if (file_exists($this->folder_path.$row->profile_image))
                @unlink($this->folder_path.$row->profile_image);
        }

        if ($request->get('password')){
            $new_password= bcrypt($request->get('password'));
        }

        $request->request->add(['password' => isset($new_password)?$new_password:$row->password]);
        $request->request->add(['profile_image' => isset($image_name)?$image_name:$row->profile_image]);

        $row->update($request->all());

        $currentRole = Auth::user()->roles()->first();

        $roles = [];
        if($request->get('role')){
            foreach ($request->get('role') as $role){
                if($currentRole->id != 1 && $role == 1)
                    return parent::invalidRequest();

                $roles[$role] = [
                    'user_id' => $row->id,
                    'role_id' => $role
                ];
            }

            $row->userRole()->sync($roles);
        }

        $request->session()->flash($this->message_success, $this->panel.' successfully updated.');
        return redirect()->route($this->base_route);
    }


    public function changePassword(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = User::find($id)) return parent::invalidRequest();

        if($request->password != $request->confirmPassword){
            $request->session()->flash($this->message_warning, 'Password & Confirm Password Not Match.');
            return redirect()->back();
        }


        if ($request->get('password')){
            $new_password= bcrypt($request->get('password'));
        }

        $request->request->add(['password' => isset($new_password)?$new_password:$row->password]);

        $row->update($request->all());

        $request->session()->flash($this->message_success,'Password Change Successfully.');
        return redirect()->back();
    }


    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = User::find($id)) return parent::invalidRequest();

        // remove old image from folder
        if ($row->profile_image && file_exists($this->folder_path.$row->profile_image)) {
            @unlink($this->folder_path.$row->profile_image);
        }

        $row->delete();

        $roles = [];
        if($request->get('role')){
            foreach ($request->get('role') as $key => $role){
                $roles[$key] = [
                    'user_id' => $row->id,
                    'role_id' => $role
                ];
            }
        }

        $row->userRole()->sync($roles);

        $request->session()->flash($this->message_success, $this->panel.' successfully deleted.');
        return redirect()->route($this->base_route);

    }

    public function active(request $request, $id)
    {
        $id = decrypt($id);

        if (!$row = User::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = User::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {

                foreach ($request->get('chkIds') as $row_id) {
                    $row_id = decrypt($row_id);

                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':

                            $row = User::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }

                            break;
                        case 'delete':
                            $row = User::find($row_id);
                            // remove old image from folder
                            if ($row->profile_image && file_exists($this->folder_path.$row->profile_image)) {
                                @unlink($this->folder_path.$row->profile_image);
                            }

                            $row->delete();

                            $roles = [];
                            if($request->get('role')){
                                foreach ($request->get('role') as $key => $role){
                                    $roles[$key] = [
                                        'user_id' => $row->id,
                                        'role_id' => $role
                                    ];
                                }
                            }

                            $row->userRole()->sync($roles);

                            break;
                    }

                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, 'Action successful.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }
}