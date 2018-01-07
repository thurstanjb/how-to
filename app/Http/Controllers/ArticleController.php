<?php

namespace App\Http\Controllers;

use App\Article;
use App\Book;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * List Articles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();

        return view('main.articles.index', compact('articles'));
    }

    /**
     * Return the article's particulars
     *
     * @param Book $book
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Book $book, Article $article)
    {

        return view('main.articles.show', compact('book', 'article'));
    }

    /**
     * Return the create form to create an article
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Return the edit form for the article
     *
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('admin.articles.edit', compact('article'));
    }
}
