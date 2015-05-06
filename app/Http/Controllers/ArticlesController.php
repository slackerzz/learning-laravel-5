<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
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
     * @param ArticleRequest $request
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        // validation is auto triggered

        Article::create($request->all());

        return redirect('articles');
    }

    /**
     * Edit an existing article;
     *
     * @param integer $id
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update an article.
     *
     * @param integer $id
     * @param ArticleRequest $request
     * @return Response
     */
    public function update($id, ArticleRequest $request)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return redirect('articles');
    }
}
