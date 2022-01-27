<?php
namespace App\Services;
use App\Contracts\CategoryInterface;
use App\Models\Category;
use App\Models\CategorySuggestion;

class CategoryService implements CategoryInterface{
    public function getAll()
    {
        return Category::orderBy('id','desc')->get();
    }
    public function find($category_id){
        return Category::find($category_id);
    }
    public function save($request){
        $arr = [
            'category_name' => $request->category_name,
            'is_active' => 1
        ];
        return Category::create($arr);
    }
    public function updateCategory($request){
        if($request->id == 1){
            return commonErrorMessage("This is default category, and not updatable.");
        }
        $category = Category::find($request->id);
        if(! empty($category)){
            $category->category_name = $request->category_name;
            if($request->has('is_active')){
                $category->is_active = $request->is_active=="on"?1:0;
            }else{
                $category->is_active = 0;
            }
            $category->save();
            return commonSuccessMessage('Category Updated Successfully');
        }else{
            return commonErrorMessage('Category Not Found');
        }
    }
}