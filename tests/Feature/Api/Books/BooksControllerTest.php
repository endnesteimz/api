<?php

namespace Tests\Feature\Api\Books;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BooksControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testBooksIndex()
    {
        $response = $this->json('GET', route('books.index'), [], [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(200);
    }

    public function testBookShow()
    {
        $book = Book::factory()->create();

        $response = $this->json('GET', route('books.show', $book->id), [], [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(200);
    }

    public function testBookStore()
    {
        $data = [
            'title'  => "Book title #1",
            'description' => "Book description #1"
        ];

        $response = $this->json('POST', route('books.store'), $data, [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(201);
	}

    public function testBookUpdate()
    {
        $book = Book::factory()->create();

        $data = [
            'title'  => "Book title update",
            'description' => "Book description update",
        ];

        $this->json('PUT', route('books.update', $book->id), $data, [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(200);
    }

    public function testBookDelete()
    {
        $book = Book::factory()->create();

        $this->json('DELETE', route('books.destroy', $book->id), [], [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(204);
    }
}
