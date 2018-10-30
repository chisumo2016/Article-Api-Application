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

    public  function  show(Article $article)
    {
        return $article;
    }

    public  function  store(Request $request, Article $article)
    {
       $article =  Article::creat($request->all());
       return response()->json($article, 201);

    }

    public  function  update(Request $request, Article $article)
    {

       $article->update($request->all());

       return  response()->json($article, 200);
    }


    public  function delete(Request $request, Article $article)
    {

        $article->delete();

        return response()->json(null, 204);
    }
}
