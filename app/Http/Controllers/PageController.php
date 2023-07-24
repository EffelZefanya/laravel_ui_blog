<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function goToAddArticle()
    {
        $category = Category::all();
        return view('add-article', ['category' => $category]);
    }
}
