<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Library;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Library\BookMaster\AddValidation;
use App\Http\Requests\Library\BookMaster\EditValidation;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookMaster;
use App\Models\BookStatus;
use App\Traits\LibraryScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use URL;
use ViewHelper;
class BookController extends CollegeBaseController
{
    protected $base_route = 'library.book';
    protected $view_path = 'library.book';
    protected $panel = 'Books';
    protected $folder_path;
    protected $folder_name = 'book';
    protected $filter_query = [];

    use LibraryScope;

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['books'] = BookMaster::select('id','code', 'title', 'image', 'categories', 'author', 'publisher', 'status')
            ->where(function ($query) use ($request) {

                if ($request->has('isbn_number')) {
                    $query->where('isbn_number', 'like', '%'.$request->isbn_number.'%');
                    $this->filter_query['isbn_number'] = $request->isbn_number;
                }

                if ($request->has('code')) {
                    $query->where('code', 'like', '%'.$request->code.'%');
                    $this->filter_query['code'] = $request->code;
                }

                if ($request->has('categories')) {
                    $query->where('categories', 'like', '%'.$request->categories.'%');
                    $this->filter_query['categories'] = $request->categories;
                }

                if ($request->has('title')) {
                    $query->where('title', 'like', '%'.$request->title.'%');
                    $this->filter_query['title'] = $request->title;
                }

                if ($request->has('author')) {
                    $query->where('author', 'like', '%'.$request->author.'%');
                    $this->filter_query['author'] = $request->author;
                }

                if ($request->has('language')) {
                    $query->where('language', 'like', '%'.$request->language.'%');
                    $this->filter_query['language'] = $request->language;
                }

                if ($request->has('publisher')) {
                    $query->where('publisher', 'like', '%'.$request->publisher.'%');
                    $this->filter_query['publisher'] = $request->publisher;
                }

                if ($request->has('publish_year')) {
                    $query->where('publish_year', 'like', '%'.$request->publish_year.'%');
                    $this->filter_query['publish_year'] = $request->publish_year;
                }

                if ($request->has('edition')) {
                    $query->where('edition', 'like', '%'.$request->edition.'%');
                    $this->filter_query['edition'] = $request->edition;
                }

                if ($request->has('edition_year')) {
                    $query->where('edition_year', 'like', '%'.$request->edition_year.'%');
                    $this->filter_query['edition_year'] = $request->edition_year;
                }

                if ($request->has('series')) {
                    $query->where('series', 'like', '%'.$request->series.'%');
                    $this->filter_query['series'] = $request->series;
                }

                if ($request->has('rack_location')) {
                    $query->where('rack_location', 'like', '%'.$request->rack_location.'%');
                    $this->filter_query['rack_location'] = $request->rack_location;
                }
            })
            ->orderBy('title','asc')
            ->get();


        $data['categories'] = $this->activeBookCategories();
        //$data['book_status'] = $this->activeBookStatus();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {

        $data = [];

        $data['categories'] = [];
        $data['categories'][0] = 'Select Category';
        foreach (BookCategory::select('id', 'title')->get() as $category) {
            $data['categories'][$category->id] = $category->title;
        }

        $data['book_status'] = [];
        $data['book_status'][0] = 'Select Status';
        foreach (BookStatus::select('id', 'title')->get() as $book_status) {
            $data['book_status'][$book_status->id] = $book_status->title;
        }

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        if ($request->hasFile('main_image')){
            $image_name = parent::uploadImages($request, 'main_image');
        }else{
            $image_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['image' => $image_name]);

        $row = BookMaster::create($request->all());

        $quantity = $request->get('end') - $request->get('start');
        if ($row && $quantity > 0) {
            $i = (int)$request->get('start');
            while ($i <= (int)$request->get('end')){
                Book::create([
                    'book_masters_id' => $row->id,
                    'book_code' => $request->get('code').$i,
                    'created_by' => auth()->user()->id,
                    'book_status' => $request->get('book_status')?$request->get('book_status'):1,
                ]);
                $i++;
            }
        }
        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_book_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        $data['row'] = BookMaster::select('id',  'isbn_number', 'code', 'title', 'sub_title', 'image',
            'language', 'editor', 'categories', 'edition', 'edition_year', 'publisher', 'publish_year', 'series', 'author',
            'rack_location', 'price', 'total_pages', 'source', 'notes', 'status')
            ->where('id','=',$id)
            ->first();
        if (!$data['row'])
            return parent::invalidRequest();

        $data['categories'] = [];
        $data['categories'][0] = 'Select Category';
        foreach (BookCategory::select('id', 'title')->get() as $category) {
            $data['categories'][$category->id] = $category->title;
        }

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = BookMaster::find($id)) return parent::invalidRequest();

        if ($request->hasFile('main_image')) {

            $image_name = parent::uploadImages($request, 'main_image');

            // remove old image from folder
            if (file_exists($this->folder_path.$row->image))
                @unlink($this->folder_path.$row->image);
        }

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['image' => isset($image_name)?$image_name:""]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function view(Request $request, $id)
    {
        $data = [];
        $data['books'] = BookMaster::select('id', 'isbn_number', 'code', 'title', 'sub_title', 'image',
            'language', 'editor', 'categories', 'edition', 'edition_year', 'publisher', 'publish_year', 'series', 'author',
            'rack_location', 'price', 'total_pages', 'source', 'notes', 'status')
            ->where('id','=',$id)
            ->orderBy('title','asc')
            ->first();

        $data['books_collection'] = Book::where('book_masters_id','=',$data['books']->id )
            ->get();

        $data['books_status'] = BookStatus::select('id', 'title', 'display_class')->get();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function delete(Request $request, $id)
    {
        if (!$row = BookMaster::find($id)) return parent::invalidRequest();

            // remove old image from folder
            if (file_exists($this->folder_path.$row->image))
                @unlink($this->folder_path.$row->image);
            foreach (config('custom.image_dimensions.book.main_image') as $dimension) {
                if (file_exists($this->folder_path.$dimension['width'].'_'.$dimension['height'].'_'.$row->image))
                    @unlink($this->folder_path.$dimension['width'].'_'.$dimension['height'].'_'.$row->image);
            }

            /*delete books copies*/
            /*$copies = Book::where('book_masters_id','=',$row->id)->get();
            if($copies){
                foreach($copies as $copy){
                    $copy->delete();
                }
            }*/
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
                        case 'active':
                        case 'in-active':
                            $row = BookMaster::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = BookMaster::find($row_id);
                            // remove old image from folder
                            if ($row->image && file_exists($this->folder_path.$row->image)) {
                                @unlink($this->folder_path.$row->image);
                                foreach (config('custom.image_dimensions.book.main_image') as $dimension) {
                                    if (file_exists($this->folder_path.$dimension['width'].'_'.$dimension['height'].'_'.$row->image))
                                        @unlink($this->folder_path.$dimension['width'].'_'.$dimension['height'].'_'.$row->image);
                                }
                            }

                            /*delete books copies*/
                                $copies = Book::where('book_masters_id','=',$row->id)->get();
                                if($copies){
                                    foreach($copies as $copy){
                                        $copy->delete();
                                    }
                                }
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, ' Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        if (!$row = BookMaster::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = BookMaster::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bookStatus(request $request, $id, $status)
    {
        if (!$row = Book::find($id)) return parent::invalidRequest();

        $request->request->add(['book_status' => $status]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Status Change Successfully.');
        return back();
    }

    public function addCopies(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        $code = $request->get('code');

        if($start == 0 or $end == 0){
            $request->session()->flash($this->message_warning, $this->panel. ' Attention!, Please Enter Start Value Greater Than 0');
            return back();
        }

        if($start > $end){
            $request->session()->flash($this->message_warning, $this->panel. ' Attention!, Yo have enter End Value is Less than Start. Correct It.');
            return back();
        }

        if($start == $end){
            $quantity = 1;
        }else{
            $quantity = ($end - $start) + 1;
        }

        if ($quantity > 0) {
            $i = 1;
            while ($i <= $quantity){
                $row = Book::where('book_code','=',$code . $start)->first();
                if($row){
                    $request->session()->flash($this->message_warning, $this->panel. ' Code Already Exist Please Correct and Try Again.');
                    return back();
                }else{
                    Book::create([
                        'book_masters_id' => $request->book_masters_id,
                        'book_code' => $code . $start,
                        'created_by' => auth()->user()->id,
                        'book_status' => 1,
                    ]);
                }
                $start++;
                $i++;
            }
        }
        $request->session()->flash($this->message_success, $this->panel. ' Copies Add Successfully.');
        return back();

    }

    public function bulkCopiesDelete(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['delete'])) {
            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $id) {
                    /*delete books copies*/
                    $row = Book::find($id);
                    $row->delete();
                }
                $request->session()->flash($this->message_success, ' Deleted successfully.');
                return back();
            }
            else{
                $request->session()->flash($this->message_warning, 'Please, Check at least One Book.');
                return redirect()->route($this->base_route);
            }

        }else return parent::invalidRequest();
    }
    
    /*bulk import*/
    public function importBook()
    {
        return view(parent::loadDataToView($this->view_path.'.import'));
    }

    public function handleImportBook(Request $request)
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
            $category = BookCategory::where('title',$row['category'])->first();
            if($category){
                $categoryId = $category->id;
            }else{
                $category = BookCategory::create([
                    'title' => strtoupper($row['category']),
                    'slug' => $row['category'],
                    'created_by' => auth()->user()->id
                ]);

                $categoryId = $category->id;
            }
            //dd($row);
            //book master validation
            $validator = Validator::make($row, [
                'code'              => 'required | max:25 | unique:book_masters,code',
                'start'             => 'required | min:1',
                'end'               => 'required | min:1',
                'title'             => 'required | max:100 | unique:book_masters,title',
                'price'             => 'required | min:1',
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }

            $book = BookMaster::create([
                'isbn_number'   => isset($row['isbn_number'])?$row['isbn_number']:'',
                'code'          => isset($row['code'])?$row['code']:'',
                'title'         => isset($row['title'])?$row['title']:'',
                'sub_title'     => isset($row['sub_title'])?$row['sub_title']:'',
                'categories'    => $categoryId,
                'author'        => isset($row['author'])?$row['author']:'',
                'price'         => isset($row['price'])?$row['price']:'',
                'edition'       => isset($row['edition'])?$row['edition']:'',
                'edition_year'  => isset($row['edition_year'])?$row['edition_year']:'',
                'language'      => isset($row['language'])?$row['language']:'',
                'publisher'     => isset($row['publisher'])?$row['publisher']:'',
                'publish_year'  => isset($row['publish_year'])?$row['publish_year']:'',
                'series'        => isset($row['series'])?$row['series']:'',
                'rack_location' => isset($row['rack_location'])?$row['rack_location']:'',
                'total_pages'   => isset($row['total_pages'])?$row['total_pages']:'',
                'source'        => isset($row['source'])?$row['source']:'',
                'created_by'    => auth()->user()->id

            ]);


            if ($row && $row['start'] > 0 && $row['end'] > 0) {
                $i = (int)$row['start'];
                while ($i <= (int)$row['end']){
                    Book::create([
                        'book_masters_id' => $book->id,
                        'book_code' => $row['code'].$i,
                        'created_by' => auth()->user()->id,
                    ]);
                    $i++;
                }
            }
        }

        $request->session()->flash($this->message_success,'Books imported Successfully');
        return redirect()->route($this->base_route);

    }

}
