<?php
namespace App\Traits;

use App\Models\BookCategory;
use App\Models\BookMaster;
use App\Models\BookStatus;
use App\Models\LibraryCirculation;

trait LibraryScope{

    public function activeBookCategories()
    {
        $category = BookCategory::Active()->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($category,'Select Category','0');
    }

    public function activeBookStatus()
    {
        $status = BookStatus::select('id', 'title')->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($status,'Select Status','0');
    }

    public function activeBookMasters()
    {
        $book = BookMaster::select('id', 'title')->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($book,'Select Book','0');
    }

    /*Library Views*/
    public function getBookCategoryById($id)
    {
        $BookCategory = BookCategory::find($id);
        if ($BookCategory) {
            return $BookCategory->title;
        }else{
            return "Unknown";
        }
    }

    /*Book Status Views*/
    public function getBookStatusById($id)
    {
        $BookStatus = BookStatus::find($id);
        if ($BookStatus) {
            return $BookStatus->title;
        }else{
            return "Unknown";
        }
    }

    /*Book Status Views*/
    public function getBookStatusClassById($id)
    {
        $BookStatus = BookStatus::find($id);
        if ($BookStatus) {
            return $BookStatus->display_class;
        }else{
            return "Unknown";
        }
    }

    /*Library User Type Views*/
    public function getLibUserTypeId($id)
    {
        $userType = LibraryCirculation::find($id);
        if ($userType) {
            return $userType->user_type;
        }else{
            return "Unknown";
        }
    }
}