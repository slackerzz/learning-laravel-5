<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\CreateArticleRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ArticlesController extends Controller {

    /**
     * Show all articles.
     *
     * @return Response
     */
    public function index()
    {
        $articles = Article::latest('published_at')->published()->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show a single article
     *
     * @param Integer $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        //dd($article);
        //dd($article->published_at);
        return view('articles.show', compact('article'));

    }

    public function create()
    {
        return view('articles.create');
    }

    /**
     * Save a new article
     *
     * @param CreateArticleRequest $request
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        // validation is auto triggered

        Article::create($request->all());

        return redirect('articles');
    }
}
