<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Product\AddValidation;
use App\Http\Requests\Product\EditValidation;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductStatus;
use App\Models\Stock;
use App\Models\SubCategory;
use App\Traits\ProductScopes;
use App\Traits\SmsEmailScope;
use App\Traits\UserScope;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image, URL;
use ViewHelper;

class ProductController extends CollegeBaseController
{
    protected $base_route = 'product';
    protected $view_path = 'product';
    protected $panel = 'Product';
    protected $folder_path;
    protected $folder_name = 'product';
    protected $filter_query = [];

    use SmsEmailScope;
    use UserScope;
    use ProductScopes;

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['product'] = Product::select('products.id',  'products.code', 'products.name', 'products.category_id',
            'products.sub_category_id', 'products.product_image', 'products.description','products.status')
            ->where(function ($query) use ($request) {

                if ($request->has('category_id') && $request->has('category_id') > 0) {
                    $query->where('products.category_id', $request->category_id );
                    $this->filter_query['products.category_id'] = $request->category_id;
                }

                if ($request->has('sub_category_id') && $request->has('sub_category_id') > 0) {
                    $query->where('products.sub_category_id', $request->sub_category_id );
                    $this->filter_query['products.sub_category_id'] = $request->sub_category_id;
                }

                if ($request->has('warranty')) {
                    $query->where('products.warranty','like', '%' . $request->warranty . '%');
                    $this->filter_query['products.warranty'] = $request->warranty;
                }

                if ($request->has('code')) {
                    $query->where('products.code','like', '%' . $request->code . '%');
                    $this->filter_query['products.code'] = $request->code;
                }

                if ($request->has('name')) {
                    $query->where('products.name','like', '%' . $request->name . '%');
                    $this->filter_query['products.name'] = $request->name;
                }

                if ($request->has('sale_price_from') && $request->has('sale_price_to')) {
                    $query->whereBetween('product_prices.sale_price', [$request->get('sale_price_from'), $request->get('sale_price_to')]);
                    $this->filter_query['sale_price_from'] = $request->get('sale_price_from');
                    $this->filter_query['sale_price_to'] = $request->get('sale_price_to');
                } elseif ($request->has('sale_price_from')) {
                    $query->where('product_prices.sale_price', '>=', $request->get('sale_price_from'));
                    $this->filter_query['sale_price_from'] = $request->get('sale_price_from');
                } elseif ($request->has('sale_price_to')) {
                    $query->where('product_prices.sale_price', '<=', $request->get('sale_price_to'));
                    $this->filter_query['sale_price_to'] = $request->get('sale_price_to');
                }

                if ($request->has('status')) {
                    $query->where('products.status', $request->status == 'active' ? 1 : 0);
                    $this->filter_query['products.status'] = $request->get('status');
                }

            })
            ->join('product_prices','product_prices.products_id','products.id')
            ->get();
        //->join('stocks','stocks.products_id','products.id')

        $category = Category::select('id', 'title')->Active()->pluck('title','id')->toArray();
        $data['category'] = array_prepend($category,'Select Category',0);

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;


        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }
    
    public function registration()
    {
        $data = [];
        $data['blank_ins'] = new Product();

        $category = Category::select('id', 'title')->Active()->pluck('title','id')->toArray();
        $data['category'] = array_prepend($category,'Select Category',0);

        $data['productCode'] = $this->randomNum($this->ProductCodeStart,6);

        return view(parent::loadDataToView($this->view_path.'.registration.register'), compact('data'));
    }

    public function register(AddValidation $request)
    {

        if ($request->hasFile('main_image')){
            $product_image = $request->file('main_image');
            $product_image_name = $request->code.'.'.$product_image->getClientOriginalExtension();
            $product_image->move(public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR, $product_image_name);
        }else{
            $product_image_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['product_image' => $product_image_name]);

        $product = Product::create($request->all());

        if($product) {

            $productStock = Stock::create([
                'created_by' => auth()->user()->id,
                'products_id' => $product->id,
                'transaction_type' => 'Registration',
                'date' => now(),
                'qty_in' => $request->stock ? $request->stock : 0,
            ]);


            $productPrice = ProductPrice::create([
                'created_by' => auth()->user()->id,
                'products_id' => $product->id,
                'cost_price' => $request->cost_price ? $request->cost_price : 0,
                'sale_price' => $request->sale_price ? $request->sale_price : 0
            ]);
        }

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function view($id)
    {
        $id = decrypt($id);


        $data = [];
        $data['product'] = Product::find($id);

        if (!$data['product']){
            request()->session()->flash($this->message_warning, "Not a Valid Product");
            return redirect()->route($this->base_route);
        }

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        $data['row'] = Product::find($id);

        if (!$data['row'])
            return parent::invalidRequest();

        $data['stock'] = $data['row']->getProductStock();
        $data['cost_price'] = $data['row']->price->cost_price;
        $data['sale_price'] = $data['row']->price->sale_price;

        $data['category'] = Category::all()->pluck('title','id');
        $data['sub_category'] = SubCategory::all()->pluck('title','id');

        return view(parent::loadDataToView($this->view_path.'.registration.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Product::find($id))
            return parent::invalidRequest();

        if($request->has('code')) {
            $code = $request->code;
            $request->request->remove('code');
        }

        if ($request->hasFile('main_image')) {
            // remove old image from folder
            if (file_exists($this->folder_path.$row->product_image))
                @unlink($this->folder_path.$row->product_image);

            /*upload new product image*/
            $product_image = $request->file('main_image');
            $product_image_name = $code.'.'.$product_image->getClientOriginalExtension();
            $product_image->move($this->folder_path, $product_image_name);
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['product_image' => isset($product_image_name)?$product_image_name:$row->product_image]);

        $product = $row->update($request->all());

        if($product){
            if($request->has('stock')){
                $stockExist = $row->getProductStock();
                $newStock = $request->stock;
                if($stockExist == $newStock){


                }elseif($stockExist > $newStock){
                    $stokDiff = $stockExist - $newStock;
                    $productStock = Stock::create([
                        'created_by' => auth()->user()->id,
                        'products_id' => $row->id,
                        'transaction_type' => 'Adjustment',
                        'date' => now(),
                        'qty_out' => $stokDiff ? $stokDiff : 0,
                    ]);

                }else{
                    $stokDiff = $newStock - $stockExist;
                    $productStock = Stock::create([
                        'created_by' => auth()->user()->id,
                        'products_id' => $row->id,
                        'transaction_type' => 'Adjustment',
                        'date' => now(),
                        'qty_in' => $stokDiff ? $stokDiff : 0,
                    ]);
                }
            }

            if($request->has('cost_price') || $request->has('sale_price')){
                $row->price()->update([
                    'last_updated_by' => auth()->user()->id,
                    'products_id' => $row->id,
                    'cost_price' => $request->cost_price ? $request->cost_price : 0,
                    'sale_price' => $request->sale_price ? $request->sale_price : 0
                ]);
            }
        }


        $request->session()->flash($this->message_success, $this->panel. ' Updated Successfully.');
        return redirect()->route($this->base_route);

    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Product::find($id)) return parent::invalidRequest();

        $row->price()->delete();
        $row->stock()->delete();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function active(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Product::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->code.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Product::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());

        //in active product login detail
        $login_detail = User::where([['role_id',5],['hook_id',$row->id]])->first();
        if($login_detail) {
            $request->request->add(['status' => 'in-active']);
            $login_detail->update($request->all());
        }

       $request->session()->flash($this->message_success, $row->code.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    $row_id = decrypt($row_id);
                    $row = Product::find($row_id);
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row->price()->delete();
                            $row->stock()->delete();
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, ucfirst($request->get('bulk_action')). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }


    public function findCategory(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('cat_id')) {
            $category = Category::find($request->get('cat_id'));

            if ($category) {
                $response['subcategory'] = $category->subCategory()->select('sub_categories.id as subCategoryId', 'sub_categories.title as subCategoryTitle')->get();

                $response['error'] = false;
                $response['success'] = 'Sub Category. Available For This Category.';
            } else {
                $response['error'] = 'No Any Sub Category Assign on This Category.';
            }

        } else {
            $response['message'] = 'Invalid request!!';
        }
        return response()->json(json_encode($response));
    }

    /*bulk import*/
    public function importProduct()
    {
        return view(parent::loadDataToView($this->view_path.'.registration.import'));
    }

    public function handleImportProduct(Request $request)
    {
        //file present or not validation
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($header) != count($row)) {
                continue;
            }

            $row = array_combine($header, $row);

            //category id
            $category = Category::where('title',$row['category'])->first();
            if($category){
                $categoryId = $category->id;
            }else{
                $category = Category::create([
                    'title' => strtoupper($row['category']),
                    'slug' => $row['category'],
                    'created_by' => auth()->user()->id
                ]);

                $categoryId = $category->id;
            }

            // Sub Category
            $sub_category = SubCategory::where('title',$row['sub_category'])->first();
            if($sub_category){
                $sub_categoryId = $sub_category->id;
            }else{
                $sub_category = SubCategory::create([
                    'category_id' => $categoryId,
                    'title' => strtoupper($row['sub_category']),
                    'created_by' => auth()->user()->id
                ]);

                $sub_categoryId = $sub_category->id;
            }

            // validation
            $validator = Validator::make($row, [
                'code'                          => 'max:15 | unique:products,code',
                'name'                          => 'required | max:100',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }

            //Product import
            $product = Product::create([
                "category_id"           => $categoryId,
                "sub_category_id"       => $sub_categoryId,
                "code"                  => $this->randomNum($this->ProductCodeStart,6),
                "name"                  => $row['name'],
                "warranty"              => $row['warranty'],
                "description"           => $row['description'],
                'created_by'            => auth()->user()->id
            ]);

            if($product) {
                $productStock = Stock::create([
                    'created_by' => auth()->user()->id,
                    'products_id' => $product->id,
                    'transaction_type' => 'Registration',
                    'date' => now(),
                    'qty_in' => $row['stock']
                ]);

                $productStock = ProductPrice::create([
                    'created_by' => auth()->user()->id,
                    'products_id' => $product->id,
                    'cost_price' => $row['cost_price'],
                    'sale_price' => $row['sale_price']
                ]);
            }
        }

        $request->session()->flash($this->message_success,'Products imported Successfully');
        return redirect()->route($this->base_route);
    }

    //info-auto comple and pull
    public function productNameAutocomplete(Request $request)
    {
        if ($request->has('q')) {

            $products = Product::select('id','code', 'name', 'description')
                ->where('code', 'like', '%'.$request->get('q').'%')
                ->orWhere('name', 'like', '%'.$request->get('q').'%')
                ->orWhere('description', 'like', '%'.$request->get('q').'%')
                ->get();

            $response = [];
            foreach ($products as $product) {
                $response[] = ['id' => $product->id, 'text' => $product->code . ' - '.$product->name ];
            }

            return json_encode($response);
        }

        abort(501);
    }

    public function productInfo(Request $request)
    {
        $response = [];
        $response['error'] = true;
        if ($request->has('id')) {
            if ($productInfo = Product::find($request->get('id'))) {
                $response['error'] = false;
                $response['html'] = view($this->view_path.'.product.pull-product-info', [
                    'productInfo' => $productInfo,
                ])->render();
                $response['message'] = 'Operation successful.';

            } else{
                $response['message'] = 'Invalid request!!';
            }
        } else{
            $response['message'] = 'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }




}
