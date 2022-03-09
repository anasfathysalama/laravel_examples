<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookCrudTest extends TestCase
{

    use RefreshDatabase;


    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testAuthUserCanCreateNewBookWithReturnedStatusSuccess(): void
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data());
        $response->assertCreated();
        $response->assertJson(['message' => "Created"]);
    }

    public function testRedirectToLoginPageIfNotAuthWith302Status(): void
    {
        $response = $this->post('/books', $this->data());
        $response->assertStatus(302);
        $response->assertRedirect("/login");

    }

    public function testTableBooksCountIs1(): void
    {
        $this->actingAs($this->user)->post("/books", $this->data());
        $this->assertDatabaseCount("books", 1);
    }

    public function testLibrarianCanSeeCreateForm(): void
    {
        $user = $this->user;
        $user->role = 'Librarian';
        $response = $this->actingAs($user)->get('books/create');
        $response->assertOk();
        $response->assertViewIs('books.create');
    }


    public function testNonLibrarianCanNotSeeCreateForm(): void
    {
        $user = $this->user;
        $user->role = 'non-Librarian';
        $response = $this->actingAs($user)->get('books/create');
        $response->assertForbidden();
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
