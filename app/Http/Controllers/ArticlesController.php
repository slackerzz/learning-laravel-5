<?php namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ArticlesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }
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

    /**
     * Show the page to create a new article.
     * @return Response
     */
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
        $article = new Article($request->all());

        Auth::user()->articles()->save($article);

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
