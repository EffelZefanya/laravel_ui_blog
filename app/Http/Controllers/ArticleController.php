<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('article', ['articles' => $articles]);
    }

    public function addArticle(Request $req)
    {
        // dd($req->all());
        $category = Category::all();

        $rules = [
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
            'image' => 'required|mimes:jpg, jpeg, png',
            'category' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $new_category = $req->category;

        $saved_category = Category::where('name', 'LIKE', '%' . $new_category . '%')->first();
        $current_user = User::where('name', 'LIKE', '%' . Auth::user()->name . '%')->first();

        $image = $req->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        $fileNameImage = $req->title . '.' . $imageExtension;

        Storage::putFileAs('public/images/', $image, $fileNameImage);

        Article::insert([
            'title' => $req->title,
            'content' => $req->content,
            'image' => $fileNameImage,
            'category_id' => $saved_category->id,
            'user_id' => $current_user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/addArticlePage')->with('message', 'Article successfully Inserted!');
    }

    public function updateArticle(Request $req, $id)
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required|max:65535',
            'image' => 'required|mimes:jpg, jpeg, png',
            'category' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $new_category = $req->category;

        $saved_category = Category::where('name', 'LIKE', '%' . $new_category . '%')->first();
        $current_user = User::where('name', 'LIKE', '%' . Auth::user()->name . '%')->first();

        $article = Article::find($id);

        if($article->image != null){
            Storage::delete('public/images/', $article->image);

            $image = $req->file('image');

            $imageExtension = $image->getClientOriginalExtension();
            $fileNameImage = $req->name . '.' . $imageExtension;

            Storage::putFileAs('public/images', $image, $fileNameImage);

            Article::where('id', $req->id)->update([
                'image' => $fileNameImage
            ]);
        }

        Article::where('id', $req->id)->update([
            'title' => $req->title,
            'content' => $req->content,
            'category_id' => $saved_category->id,
            'user_id' => $current_user->id,
            'updated_at' => Carbon::now()
        ]);

        return redirect('/updateArticlePage/'.$req->id)->with('message', 'Article successfully updated!');
    }

    public function deleteArticle($id){
        $article = Article::find($id);

        if(isset($article)){
            Storage::delete('public/'.$article->image);
            $article->delete();
        }

        return redirect('/articles');
    }
}
