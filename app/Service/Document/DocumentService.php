<?php

namespace App\Service\Document;

use App\DTO\Document\DocumentDTO;
use App\Job\ProcessDocument;
use App\Repository\Document\Collection\DocumentCollection;
use App\Repository\Document\Contract\DocumentRepository;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    const LOCAL_DISK = 'local';
    const DOCUMENT_FILE_NAME = '2023-03-28.json';

    public function __construct(private DocumentRepository $repository)
    {
    }

    public function getAll(): DocumentCollection
    {
        return $this->repository->getAll();
    }

    public function save(DocumentDTO $document): void
    {
        $this->repository->save($document);
    }

    public function runQueue(): void
    {
        $documents = json_decode(Storage::disk(self::LOCAL_DISK)->get(self::DOCUMENT_FILE_NAME))?->documentos;

        foreach ($documents as $document) {
            ProcessDocument::dispatch(
                DocumentDTO::fromArray((array) $document)
            );
        }
    }
}
