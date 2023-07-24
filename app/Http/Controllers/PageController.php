<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function goToAddArticle()
    {
        $category = Category::all();
        return view('add-article', ['category' => $category]);
    }

    public function goToUpdateArticle($id)
    {
        $article = Article::find($id);
        $category = Category::all();
        return view('update-article', ['article' => $article, 'category' => $category]);
    }

    public function goToAddCategory(){
        return view('add-category');
    }

    public function goToUpdateCategory($id)
    {
        $category = Category::find($id);
        return view('update-category',['category' => $category]);
    }

    public function readArticle($id){
        $article = Article::find($id);

        return view('article-detail', ['article' => $article]);
    }
}
