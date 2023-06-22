<?php

namespace Entity\Document;
use App\Entity\Document\Category;
use App\Entity\Document\Document;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    public function testShouldConvertToArrayCorrectly(): void
    {
        $category = new Category(
            id: 1,
            name: 'Test Category',
        );

        $document = new Document(
            title: 'Test Document',
            contents: 'Lorem ipsum',
            category: $category,
        );

        $expectedArray = [
            'title' => 'Test Document',
            'contents' => 'Lorem ipsum',
            'category' => [
                'id' => 1,
                'name' => 'Test Category',
            ],
        ];

        $this->assertEquals($expectedArray, $document->toArray());
    }

    public function testShouldCreateEntityFromArrayCorrectly(): void
    {
        $data = [
            'title' => 'Test Document',
            'contents' => 'Lorem ipsum',
            'category' => [
                'id' => 1,
                'name' => 'Test Category',
            ],
        ];

        $document = Document::fromArray($data);

        $this->assertInstanceOf(Document::class, $document);
        $this->assertEquals('Test Document', $document->title);
        $this->assertEquals('Lorem ipsum', $document->contents);
        $this->assertInstanceOf(Category::class, $document->category);
        $this->assertEquals(1, $document->category->id);
        $this->assertEquals('Test Category', $document->category->name);
    }

    public function testShouldCreateArrayOfEntityCorrectly(): void
    {
        $data = [
            [
                'title' => 'Document 1',
                'contents' => 'Lorem ipsum 1',
                'category' => [
                    'id' => 1,
                    'name' => 'Category 1',
                ],
            ],
            [
                'title' => 'Document 2',
                'contents' => 'Lorem ipsum 2',
                'category' => [
                    'id' => 2,
                    'name' => 'Category 2',
                ],
            ],
        ];

        $documents = Document::arrayOf($data);

        $this->assertCount(2, $documents);

        foreach ($documents as $document) {
            $this->assertInstanceOf(Document::class, $document);
            $this->assertInstanceOf(Category::class, $document->category);
        }
    }
}
