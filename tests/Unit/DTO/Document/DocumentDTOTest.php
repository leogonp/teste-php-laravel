<?php

namespace Tests\Unit\DTO\Document;

use App\DTO\Document\DocumentDTO;
use App\Enum\Document\DocumentCategoryEnum;
use PHPUnit\Framework\TestCase;

class DocumentDTOTest extends TestCase
{
    public function testShouldConvertToArrayCorrectly(): void
    {
        $documentDTO = new DocumentDTO(
            title: 'Test Document',
            categoryId: DocumentCategoryEnum::PARTIAL_SHIPPING,
            contents: 'This is a test document.',
        );

        $expectedArray = [
            'title' => 'Test Document',
            'category_id' => DocumentCategoryEnum::PARTIAL_SHIPPING->value,
            'contents' => 'This is a test document.',
        ];

        $this->assertEquals($expectedArray, $documentDTO->toArray());
    }

    public function testShouldCreateDTOFromArrayCorrectly(): void
    {
        $data = [
            'titulo' => 'Test Document',
            'categoria' => 'Remessa',
            'conteúdo' => 'This is a test document.',
        ];

        $documentDTO = DocumentDTO::fromArray($data);

        $this->assertInstanceOf(DocumentDTO::class, $documentDTO);
        $this->assertEquals('Test Document', $documentDTO->title);
        $this->assertEquals(DocumentCategoryEnum::SHIPPING, $documentDTO->categoryId);
        $this->assertEquals('This is a test document.', $documentDTO->contents);
    }
}
