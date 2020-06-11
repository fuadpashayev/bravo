<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts(){
        return $this->hasMany('\App\Post','category_id','id');
    }

    public static function getCategories($onlyActives = false)
    {
        $data = [];
        $categories = Category::where('parent_id',null);
        if($onlyActives){
            $categories = $categories->where('status',true);
        }
        $categories = $categories->orderBy('order','asc')->get();
        foreach ($categories as $category){
            if(!Category::hasSubCategories($category->id)){
                $data[] = $category;
            }else{
                $subCategories = Category::getSubCategories($category->id);
                $category->subcategories = $subCategories;
                $data[] = $category;
            }

        }
        return $data;
    }

    public static function hasSubCategories($category_id){
        return Category::where('parent_id',$category_id)->count();
    }

    public static function getSubCategories($category_id)
    {
        $data = [];
        $subCategories = Category::where('parent_id',$category_id)->orderBy('order','asc')->get();
        foreach ($subCategories as $subCategory){
            if(!Category::hasSubCategories($subCategory->id)){
                $data[] = $subCategory;
            }else{
                $subCategories = Category::getSubCategories($subCategory->id);
                $subCategory->subcategories = $subCategories;
                $data[] = $subCategory;
            }

        }
        return $data;
    }
}
