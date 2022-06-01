<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:191',
            'name' => 'required|max:191',
            'meta_title' => 'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            $category = new Category;
            $category->slug = $request->input('slug');
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == true ? '1' : '0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_keyword = $request->input('meta_keyword');
            $category->meta_description = $request->input('meta_description');
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => 'Category created successfully',
            ]);
        }
    }

    public function edit($id){
        $category = Category::find($id);
        if($category){
            return response()->json([
                'status' => 200,
                'category' => $category,
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message' => 'No category found with this id',
            ]);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'slug' => 'required|max:191',
            'name' => 'required|max:191',
            'meta_title' => 'required|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            $category = Category::find($id);
            if($category){
                $category->slug = $request->input('slug');
                $category->name = $request->input('name');
                $category->description = $request->input('description');
                $category->status = $request->input('status') == true ? '1' : '0';
                $category->meta_title = $request->input('meta_title');
                $category->meta_keyword = $request->input('meta_keyword');
                $category->meta_description = $request->input('meta_description');
                $category->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Category updated successfully',
                ]);
            }
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Category found with this id',
                ]);
            }

        }
    }

}
