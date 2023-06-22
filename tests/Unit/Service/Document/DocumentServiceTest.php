<?php

namespace Tests\Unit\Service\Document;

use App\DTO\Document\DocumentDTO;
use App\Job\ProcessDocument;
use App\Repository\Document\Collection\DocumentCollection;
use App\Repository\Document\Contract\DocumentRepository;
use App\Service\Document\DocumentService;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentServiceTest extends TestCase
{
    private DocumentService $documentService;
    private DocumentRepository $documentRepository;
    private DocumentCollection $documentCollection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->documentRepository = $this->mock(DocumentRepository::class);
        $this->documentCollection = $this->mock(DocumentCollection::class);

        $this->documentService = new DocumentService($this->documentRepository);
    }

    public function testWillGetAllCorrectly(): void
    {
        $this->documentRepository
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($this->documentCollection);

        $result = $this->documentService->getAll();

        $this->assertInstanceOf(DocumentCollection::class, $result);
    }

    public function testShouldSaveCorrectly(): void
    {
        $documentDTO = $this->mock(DocumentDTO::class);

        $this->documentRepository
            ->shouldReceive('save')
            ->once()
            ->with($documentDTO);

        $this->documentService->save($documentDTO);
    }

    public function testShouldRunQueueCorrectly(): void
    {
        $documentos = json_decode('[ { "categoria":  "Remessa", "titulo": "value1", "conteúdo": "value2"}, { "categoria":  "Remessa Parcial", "titulo": "value3", "conteúdo": "value4" } ]');

        Storage::shouldReceive('disk->get')
            ->once()
            ->andReturn(json_encode(['documentos' => $documentos]));

        Queue::fake();

        $this->assertNull($this->documentService->runQueue());

        Queue::assertPushed(ProcessDocument::class);
    }
}
