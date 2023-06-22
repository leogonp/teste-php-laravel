<?php

namespace Tests\Unit\Job;

use App\DTO\Document\DocumentDTO;
use App\Enum\Document\DocumentCategoryEnum;
use App\Job\ProcessDocument;
use App\Service\Document\DocumentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessDocumentTest extends TestCase
{
    public function testHandle(): void
    {
        $documentDTO = new DocumentDTO('Example Title', DocumentCategoryEnum::PARTIAL_SHIPPING, 'Example Content');
        $job = new ProcessDocument($documentDTO);

        $serviceMock = $this->mock(DocumentService::class);
        $serviceMock->shouldReceive('save')
            ->once()
            ->with($documentDTO);

        $job->handle($serviceMock);
    }
}
