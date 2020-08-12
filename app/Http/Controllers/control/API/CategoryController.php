<?php

namespace App\Http\Controllers\control\API;

use App\control\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return parent::success($categories, 200);
    }

    public function show($id) {
        try {
            $category = Category::findOrFail($id);
            return parent::success($category);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('Category Not Found!!', 404);
        }
    }


    public function store(Request $request) {
        $validation = \Validator::make($request->all(), $this->rules());
        if($validation->fails()) {
            return parent::error($validation->errors(), 400);
        }
        $category = new Category();
        $category->fill($request->all());
        $category->image = parent::uploadImage($request->file('image'), 'category');
        $category->save();
        return parent::success($category);
    }

    public function update(Request $request, $id) {
        $validation = \Validator::make($request->all(), $this->rules($id));
        if($validation->fails())
        return parent::error($validation->errors());

        try {
            $category = Category::findOrFail($id);
            $category->fill($request->all());
            if($request->hasFile('image')) {
                $image_path = parent::uploadImage($request->file('image'), 'category');
                if (\File::exists(public_path($category->image))) {
                    \File::delete((public_path($category->image)));
                }
                $category->image = $image_path;
            }
            $category->update();
            return parent::success($category);
        } catch(ModelNotFoundException $ModelNotFoundException) {
            return parent::error('Category Not Found!!', 404);
        }
    }

    public function destroy($id) {
        try{
            $category = Category::findOrFail($id);
            $result = $category->delete();
            if($result === TRUE)
                return parent::success($category);
            return parent::error('Some Thing Went Wrong!!');
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('Category Not Found!!');
        }
    }


    private function rules($id = null) {
        $rules = [];
        return $rules;
    }
}
