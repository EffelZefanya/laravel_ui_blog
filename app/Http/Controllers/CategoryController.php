<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', ['categories' => $categories]);
    }

    public function addCategory(Request $req){
        // dd($req->all());

        $rules = [
            'name' => 'required|max:255|unique:categories',
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $current_user = User::where('name', 'LIKE', '%' . Auth::user()->name . '%')->first();

        Category::insert([
            'name' =>$req->name,
            'user_id' => $current_user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/addCategoryPage')->with('message', 'Category successfully inserted');
    }

    public function deleteCategory($id){
        $category = Category::find($id);

        if(isset($category)){
            $category->delete();
        }

        return redirect('/categories');
    }

    public function updateCategory(Request $req, $id){
        $rules = [
            'name' => 'required|max:255|unique:categories',
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $current_user = User::where('name', 'LIKE', '%' . Auth::user()->name . '%')->first();

        Category::where('id', $req->id)->update([
            'name' =>$req->name,
            'user_id' => $current_user->id,
            'updated_at' => Carbon::now()
        ]);

        return redirect('/updateCategoryPage/' . $req->id)->with('message', 'Category successfully updated');
    }
}
