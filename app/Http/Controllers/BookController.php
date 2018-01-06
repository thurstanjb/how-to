<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Return list view of all books
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $books = Book::orderby('created_at')->get();

        return view('main.books.index', compact('books'));
    }

    /**
     * Return the books particulars
     *
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Book $book){
        return view('main.books.show', compact('book'));
    }

    /**
     * Return the new book form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.books.create');
    }

    /**
     * Store a new book
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $valid = $this->validate($request, [
            'title' => 'required',
            'description' => 'present'
        ]);

        $valid['user_id'] = auth()->user()->id;
        $book = Book::create($valid);

        return redirect()->route('books.show', ['book' => $book])
            ->with('flash', 'Your book has been created!');
    }

    /**
     * Return the book edit form
     *
     * @param Book $book
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Book $book){
        try{
            $this->authorize('update', $book);
        } catch(\Exception $e){
            return redirect('/');
        }

        return view('admin.books.edit', compact('book'));

    }

    /**
     * Update the given book with new values.
     *
     * @param Book $book
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Book $book, Request $request){
        try{
            $this->authorize('update', $book);
        }catch(\Exception $e){
            return redirect('/');
        }

        $valid = $this->validate($request, [
            'title' => 'required',
            'description' => 'present'
        ]);
        $book->update($valid);

        return redirect()->route('books.show', ['book' => $book])
            ->with('flash', 'Your book has been updated');
    }

    /**
     * Delete the required book
     *
     * @param Book $book
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy(Book $book){
        try{
            $this->authorize('delete', $book);
        }catch(\Exception $e){
            return redirect('/');
        }

        $book->delete();

        if(request()->wantsJson()){
            return response([], 204);
        }

        return redirect('/books')
            ->with('flash', 'Your book has been deleted!');
    }

}
