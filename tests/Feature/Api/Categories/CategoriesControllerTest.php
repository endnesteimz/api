<?php

namespace Tests\Feature\Api\Categories;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCategoryIndex()
    {
        $response = $this->json('GET', route('categories.index'), [], [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(200);
    }

    public function testCategoryShow()
    {
        $categories = Category::factory()->create();

        $response = $this->json('GET', route('categories.show', $categories->id), [], [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(200);
    }

    public function testCategoryStore()
    {
        $data = [
            'book_id'  => "2",
            'name' => "Categories #1",
        ];

        $response = $this->json('POST', route('categories.store'), $data, [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(201);
	}

    public function testCategoryUpdate()
    {
        $categories = Category::factory()->create();

        $data = [
            'id' => "4",
            'book_id'  => "2",
            'name' => "Categories #2",
        ];

        $this->json('PUT', route('categories.update', $categories->id), $data, [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(200);
    }

    public function testCategoryDelete()
    {
        $categories = Category::factory()->create();

        $this->json('DELETE', route('categories.destroy', $categories->id), [], [], [], [
            "HTTP_Authorization" => "Bearer mytoken",
        ])->assertStatus(204);
    }
}
