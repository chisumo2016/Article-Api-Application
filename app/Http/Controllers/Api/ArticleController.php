<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    public  function  index()
    {
        return Article::all();
    }

    public  function  show($id)
    {
        return Article::find($id);
    }

    public  function  store(Request $request)
    {
        return Article::creat($request->all());
    }

    public  function  update(Request $request, $id)
    {
       $article =  Article::findOrFail($id);
       $article->update($request->all());

       return $article;
    }


    public  function delete(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
}
