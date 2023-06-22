<?php

namespace Tests\Unit\Entity\Document;

use App\Entity\Document\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testShouldConvertToArrayCorrectly(): void
    {
        $category = new Category(
            id: 1,
            name: 'Test Category',
        );

        $expectedArray = [
            'id' => 1,
            'name' => 'Test Category',
        ];

        $this->assertEquals($expectedArray, $category->toArray());
    }

    public function testShouldCreateEntityFromArrayCorrectly(): void
    {
        $data = [
            'id' => 1,
            'name' => 'Test Category',
        ];

        $category = Category::fromArray($data);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals(1, $category->id);
        $this->assertEquals('Test Category', $category->name);
    }

    public function testArrayOf()
    {
        $data = [
            ['id' => 1, 'name' => 'Category 1'],
            ['id' => 2, 'name' => 'Category 2'],
            ['id' => 3, 'name' => 'Category 3'],
        ];

        $categories = Category::arrayOf($data);

        $this->assertCount(3, $categories);

        foreach ($categories as $category) {
            $this->assertInstanceOf(Category::class, $category);
        }
    }
}
