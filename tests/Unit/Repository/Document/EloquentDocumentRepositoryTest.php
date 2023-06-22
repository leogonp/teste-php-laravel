<?php

namespace Repository\Document;

use App\DTO\Document\DocumentDTO;
use App\Entity\Document\Document;
use App\Enum\Document\DocumentCategoryEnum;
use App\Models\Document\Document as DocumentModel;
use App\Repository\Document\Collection\DocumentCollection;
use App\Repository\Document\Contract\DocumentRepository;
use App\Repository\Document\EloquentDocumentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentDocumentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private DocumentRepository $repository;
    private DocumentModel $documentModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->documentModel = $this->mock(DocumentModel::class);
        $this->repository = new EloquentDocumentRepository($this->documentModel);
    }

    public function testShouldGetAllCorrecly(): void
    {
        $document1 = Document::fromArray([
            'title' => 'Document 1',
            'contents' => 'Content 1',
            'category' => [
                'id' => 1,
                'name' => 'Category 1',
            ],
        ]);

        $document2 = Document::fromArray([
            'title' => 'Document 2',
            'contents' => 'Content 2',
            'category' => [
                'id' => 2,
                'name' => 'Category 2',
            ],
        ]);

        $documentModels = [$document1->toArray(), $document2->toArray()];

        $this->documentModel
            ->shouldReceive('newQuery->with->get->toArray')
            ->once()
            ->andReturn($documentModels);

        $expectedCollection = new DocumentCollection([$document1, $document2]);
        $actualCollection = $this->repository->getAll();

        $this->assertEquals($expectedCollection, $actualCollection);
    }

    public function testSave()
    {
        $documentDTO = new DocumentDTO(
            'New Document',
            DocumentCategoryEnum::PARTIAL_SHIPPING,
            'New Content'
        );

        $this->documentModel
            ->shouldReceive('create')
            ->with($documentDTO->toArray())
            ->once();

        $this->repository->save($documentDTO);
    }
}
