<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['name', 'isbn', 'value']);
        $book = Book::create($data);
        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->only(['name', 'isbn', 'value']);
        $book->update($data);
        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted']);
    }
}
