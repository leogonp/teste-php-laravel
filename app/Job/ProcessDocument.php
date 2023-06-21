<?php

namespace App\Job;

use App\DTO\Document\DocumentDTO;
use App\Service\Document\DocumentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class ProcessDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public function __construct(
        private DocumentDTO $payload
    )
    {
    }

    public function handle(DocumentService $service): void
    {
        $service->save($this->payload);
    }
}
