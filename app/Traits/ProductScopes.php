<?php
namespace App\Traits;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStatus;
use App\Models\SubCategory;

trait ProductScopes{
    public function getProductById($id)
    {
        $product = Product::find($id);
        if ($product) {
            return $product->code;
        }else{
            return "Unknown";
        }
    }

    public function getProductIdByReg($code)
    {
        $product = Product::where('code',$code)->first();
        if ($product) {
            return $product->id;
        }else{
            return "Unknown";
        }
    }

    public function getProductNameById($id)
    {
        $product = Product::find($id);
        if ($product) {
            return $product->name;
        }else{
            return "Unknown";
        }
    }


    public function getProductRegById($reg)
    {
        $product = Product::where('code',$reg)->first();
        if ($product) {
            return $product->code;
        }else{
            return "Unknown";
        }
    }

    public function getProductNameByReg($reg)
    {
        $product = Product::where('code',$reg)->first();
        if ($product) {
            return $product->name ;
        }else{
            return "Unknown";
        }
    }

    public function getProductStatus($id)
    {
        $product = ProductStatus::where('id',$id)->first();
        if ($product) {
            return $product->title;
        }else{
            return "Unknown";
        }
    }


    public function getProductCategory($id)
    {
        $category = Category::where('id',$id)->first();
        if ($category) {
            return $category->title;
        }else{
            return "Unknown";
        }
    }

    public function getProductSubCategory($id)
    {
        $subcategory = SubCategory::where('id',$id)->first();
        if ($subcategory) {
            return $subcategory->title;
        }else{
            return "Unknown";
        }
    }


}