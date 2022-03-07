<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {
        return response(["message" => "Created"], 201);
    }
}
