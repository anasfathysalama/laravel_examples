<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testTitleFieldIsRequired(): void
    {
        $response = $this->post("/books", $this->data(['title' => ""]));
        $response->assertSessionHasErrors(['title' => 'title is required']);
    }

    public function testDescriptionIsRequired(): void
    {
        $response = $this->post("/books", $this->data(['description' => ""]));
        $response->assertSessionHasErrors(['description' => 'description is required']);
    }

    public function testDescriptionLengthMinimumIs20Characters(): void
    {
        $response = $this->post("/books", $this->data(['description' => "this is description"]));
        $response->assertSessionHasErrors(['description' => 'description must not less than 20 characters']);
    }

    public function testAuthorIdMustBeValid(): void
    {
        $response = $this->post("/books", $this->data());
        $response->assertSessionHasErrors(['author_id' => 'Author must be valid']);
    }

    public function testIsbnBeValidFormat(): void
    {
        $response = $this->post("/books", $this->data(['ISBN' => "sadsasd-i"]));
        $response->assertSessionHasErrors(['ISBN' => 'ISBN should be in valid format']);
    }

    private function data($data = []): array
    {
        $default = [
            "title" => "First Book",
            "description" => "First Book Description",
            "author_id" => 1,
            "ISBN" => "G3F-DRT-3ff3"
        ];
        return array_merge($default, $data);
    }
}
