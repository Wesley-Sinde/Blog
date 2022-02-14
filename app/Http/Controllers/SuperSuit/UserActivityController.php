<?php

/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\SuperSuit;

use App\Http\Controllers\CollegeBaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image, URL;
use OwenIt\Auditing\Models\Audit;
use ViewHelper;

class UserActivityController extends CollegeBaseController
{
    protected $base_route = 'super-suit.user-activity';
    protected $view_path = 'super-suit.user-activity';
    protected $panel = 'User Activity';
    protected $filter_query = [];

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()){
            $data['user-activity'] = Audit::select('audits.id','audits.ip_address','audits.user_id','audits.event','audits.user_agent', 'audits.url',
                'audits.created_at','audits.updated_at','audits.old_values','audits.new_values','audits.tags','u.name', 'r.display_name')
                ->where(function ($query) use ($request) {

                    if ($request->has('ip')) {
                        $query->where('audits.ip_address', '=',  $request->ip);
                        $this->filter_query['ip_address'] = $request->ip;
                    }

                    if ($request->has('user')) {
                        $query->where('audits.user_id', '=',  $request->user);
                        $this->filter_query['user_id'] = $request->user;
                    }

                    if ($request->has('event')) {
                        $query->where('audits.event', '=',  $request->event);
                        $this->filter_query['event'] = $request->event;
                    }

                    if ($request->has('user_agent')) {
                        $query->where('audits.user_agent', 'like', '%' . $request->user_agent . '%');
                        $this->filter_query['user_agent'] = $request->user_agent;
                    }

                    if ($request->has('url')) {
                        $query->where('audits.url', 'like', '%' . $request->url . '%');
                        $this->filter_query['url'] = $request->url;
                    }

                    if ($request->has('created_at_start_date') && $request->has('created_at_end_date')) {
                        $query->whereBetween('created_at', [$request->get('created_at_start_date'), $request->get('created_at_end_date')]);
                        $this->filter_query['created_at_start_date'] = $request->get('created_at_start_date');
                        $this->filter_query['created_at_end_date'] = $request->get('created_at_end_date');
                    } elseif ($request->has('created_at_start_date')) {
                        $query->where('audits.created_at', '>=', $request->get('created_at_start_date'));
                        $this->filter_query['created_at_start_date'] = $request->get('created_at_start_date');
                    } elseif ($request->has('created_at_end_date')) {
                        $query->where('audits.created_at', '<=', $request->get('created_at_end_date'));
                        $this->filter_query['created_at_end_date'] = $request->get('created_at_end_date');
                    }

                    if ($request->has('updated_at_start_date') && $request->has('updated_at_end_date')) {
                        $query->whereBetween('updated_at', [$request->get('updated_at_start_date'), $request->get('updated_at_end_date')]);
                        $this->filter_query['updated_at_start_date'] = $request->get('updated_at_start_date');
                        $this->filter_query['updated_at_end_date'] = $request->get('updated_at_end_date');
                    } elseif ($request->has('updated_at_start_date')) {
                        $query->where('audits.updated_at', '>=', $request->get('updated_at_start_date'));
                        $this->filter_query['updated_at_start_date'] = $request->get('updated_at_start_date');
                    } elseif ($request->has('updated_at_end_date')) {
                        $query->where('audits.updated_at', '<=', $request->get('updated_at_end_date'));
                        $this->filter_query['updated_at_end_date'] = $request->get('updated_at_end_date');
                    }

                })
                ->join('users as u','u.id','=','audits.user_id')
                ->join('role_user as ru','ru.user_id','=','audits.user_id')
                ->join('roles as r','r.id','=','ru.role_id')
                ->latest()
                ->get();
        }else{
            $data['user-activity'] = Audit::select('audits.id','audits.ip_address','audits.user_id','audits.event','audits.user_agent', 'audits.url',
                'audits.created_at','audits.updated_at','audits.old_values','audits.new_values','audits.tags','u.name', 'r.display_name')
                ->where(function ($query) use ($request) {

                    if ($request->has('ip')) {
                        $query->where('audits.ip_address', '=',  $request->ip);
                        $this->filter_query['ip_address'] = $request->ip;
                    }

                    if ($request->has('user')) {
                        $query->where('audits.user_id', '=',  $request->user);
                        $this->filter_query['user_id'] = $request->user;
                    }

                    if ($request->has('event')) {
                        $query->where('audits.event', '=',  $request->event);
                        $this->filter_query['event'] = $request->event;
                    }

                    if ($request->has('user_agent')) {
                        $query->where('audits.user_agent', 'like', '%' . $request->user_agent . '%');
                        $this->filter_query['user_agent'] = $request->user_agent;
                    }

                    if ($request->has('url')) {
                        $query->where('audits.url', 'like', '%' . $request->url . '%');
                        $this->filter_query['url'] = $request->url;
                    }

                    if ($request->has('created_at_start_date') && $request->has('created_at_end_date')) {
                        $query->whereBetween('created_at', [$request->get('created_at_start_date'), $request->get('created_at_end_date')]);
                        $this->filter_query['created_at_start_date'] = $request->get('created_at_start_date');
                        $this->filter_query['created_at_end_date'] = $request->get('created_at_end_date');
                    } elseif ($request->has('created_at_start_date')) {
                        $query->where('audits.created_at', '>=', $request->get('created_at_start_date'));
                        $this->filter_query['created_at_start_date'] = $request->get('created_at_start_date');
                    } elseif ($request->has('created_at_end_date')) {
                        $query->where('audits.created_at', '<=', $request->get('created_at_end_date'));
                        $this->filter_query['created_at_end_date'] = $request->get('created_at_end_date');
                    }

                    if ($request->has('updated_at_start_date') && $request->has('updated_at_end_date')) {
                        $query->whereBetween('updated_at', [$request->get('updated_at_start_date'), $request->get('updated_at_end_date')]);
                        $this->filter_query['updated_at_start_date'] = $request->get('updated_at_start_date');
                        $this->filter_query['updated_at_end_date'] = $request->get('updated_at_end_date');
                    } elseif ($request->has('updated_at_start_date')) {
                        $query->where('audits.updated_at', '>=', $request->get('updated_at_start_date'));
                        $this->filter_query['updated_at_start_date'] = $request->get('updated_at_start_date');
                    } elseif ($request->has('updated_at_end_date')) {
                        $query->where('audits.updated_at', '<=', $request->get('updated_at_end_date'));
                        $this->filter_query['updated_at_end_date'] = $request->get('updated_at_end_date');
                    }

                })
                ->join('users as u','u.id','=','audits.user_id')
                ->join('role_user as ru','ru.user_id','=','audits.user_id')
                ->join('roles as r','r.id','=','ru.role_id')
                ->limit(10)
                ->latest()
                ->get();
        }


        $faculty = User::where('status',1)->pluck('name','id')->toArray();
        $data['users'] = array_prepend($faculty,'Select User Name','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Audit::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'delete':
                            $row = Audit::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

}
