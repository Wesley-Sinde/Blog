<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Product\Category\AddValidation;
use App\Http\Requests\Product\Category\EditValidation;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends CollegeBaseController
{
    protected $base_route = 'product.category';
    protected $view_path = 'product.category';
    protected $panel = 'Product Category';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index()
    {
       $data = [];
       $data['category'] = Category::select('id', 'title', 'status')
            ->orderBy('title')
            ->get();

       return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['slug' => $request->get('title')]);

        $category = Category::create($request->all());

        if($request->get('name')){
            foreach ($request->get('name') as $key => $row_id){
                $subCategory = [
                    'category_id' => $category->id,
                    'title' => $row_id,
                    'created_by' => auth()->user()->id
                ];
                SubCategory::create($subCategory);
            }
        }

        $request->session()->flash($this->message_success, $this->panel. 'Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = [];
        if (!$data['row'] = Category::find($id))
            return parent::invalidRequest();

        $data['category'] = Category::select('id', 'title', 'status')
            ->orderBy('title')
            ->get();

        $data['sub_category'] = $data['row']->subCategory('id','name')->get();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Category::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);

        //update & add grade scales
        if($request->has('catID')) {
            foreach ($request->get('catID') as $key => $subCat) {
                $existsubCat = SubCategory::find($subCat);
                if (!$existsubCat) {
                    //create
                    $subCategory = [
                        'category_id' => $row->id,
                        'title' => $request->get('name')[$key],
                        'created_by' => auth()->user()->id
                    ];
                    SubCategory::create($subCategory);

                } else {
                    //update
                    $existsubCat->update([
                        'category_id' => $row->id,
                        'title' => $request->get('name')[$key],
                        'last_updated_by' => auth()->user()->id
                    ]);

                }
            }
        }



        //update category type
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Category::find($id)) return parent::invalidRequest();

        //remove associate scale
        $row->subCategory()->delete();
        //delete category
        $row->delete();
        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
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
                            $row = Category::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Category::find($row_id);
                            //remove associate scale
                            $row->subCategory()->delete();
                            //delete category
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

    public function active(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Category::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Category::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function subCatHtmlRow()
    {
        $response['html'] = view($this->view_path.'.includes.subcat_tr')->render();
        return response()->json(json_encode($response));
    }
}
