<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store(BookRequest $request)
    {
        Book::create($request->validated());
        return response(["message" => "Created"], 201);
    }

    public function create()
    {
        return view('books.create');
    }
}
