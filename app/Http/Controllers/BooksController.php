<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {

        return response()->json(["books" => BookResource::collection(Book::get())]);
    }

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
