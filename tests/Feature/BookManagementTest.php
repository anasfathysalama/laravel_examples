<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookManagementTest extends TestCase
{

    public function testCreateNewBookWithReturedStausSucess()
    {

        $this->withoutExceptionHandling();
        $response = $this->post("/books", [
            "title" => "First Book",
            "description" => "First Book Description",
            "author_id" => 1
        ]);

        $response->assertCreated();
        $response->assertJson(['message' => "Created"]);
    }
}
