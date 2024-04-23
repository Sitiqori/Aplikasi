<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\KoleksiPribadi;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', 1);
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function cetak()
{
    $books = Book::get();
    $datacetak = $books; // Jika Anda ingin mengirimkan data lain ke view, Anda bisa menambahkannya di sini

    return view('books.cetak', compact('books', 'datacetak'));
}

    public function add()
    {
        $categories = Category::all();
        return view('books.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'book_code' => 'required|unique:books|max:100',
            'title' => 'required|max:255',
        ]);

        $newImage = '';
        if ($request->file('image')) {
            $exten = $request->file('image')->getClientOriginalExtension();
            $newImage = $request->title . '-' . now()->timestamp . '.' . $exten;
            $request->file('image')->storeAs('cover', $newImage);
        }

        $request['cover'] = $newImage;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book Added Successfully');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update($slug, Request $request)
    {
        if ($request->file('image')) {
            $exten = $request->file('image')->getClientOriginalExtension();
            $newImage = $request->title . '-' . now()->timestamp . '.' . $exten;
            $request->file('image')->storeAs('cover', $newImage);
            $request['cover'] = $newImage;
        }

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'Book Updated Successfully');
    }

    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('books')->with('status', 'Book Deleted Successfully');
    }

    public function deleted()
    {
        $book = Book::onlyTrashed()->get();
        return view('books.deleted', compact('book'));
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('books')->with('status', 'Book Restored Successfully');
    }














    public function data()
    {
        $books = Book::all();
        $book_count = Book::count();

        return view('books.buku', compact('books', 'book_count'));
    }

    public function addToCollection($book_id)
{
    // Get the authenticated user
    $user = auth()->user();

    // Find the book by ID
    $book = Book::findOrFail($book_id);

    // Attach the book to the user's collection
    $user->koleksipribadi()->attach($book);

    return redirect()->back()->with('success', 'Book added to your collection.');
}
}
