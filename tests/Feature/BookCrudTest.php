<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookCrudTest extends TestCase
{

    use RefreshDatabase;

    private $response;

    public function setUp(): void
    {
        parent::setUp();
        $this->response = $this->post("/books", $this->data());
    }

    public function testCreateNewBookWithReturnedStatusSuccess(): void
    {
        $this->withoutExceptionHandling();
        $this->response->assertCreated();
        $this->response->assertJson(['message' => "Created"]);
    }

    public function testTableBooksCountIs1(): void
    {
        $this->assertDatabaseCount("books", 1);
    }



    private function data($data = []): array
    {
        $author = Author::factory()->create();
        $default = [
            "title" => "First Book",
            "description" => "First Book Description",
            "author_id" => $author->id,
            "ISBN" => "G3F-DRT-3ff3"
        ];
        return array_merge($default, $data);
    }
}
