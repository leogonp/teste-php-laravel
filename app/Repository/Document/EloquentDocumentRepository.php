<?php

namespace App\Repository\Document;

use App\DTO\Document\DocumentDTO;
use App\Entity\Document\Document;
use App\Models\Document\Document as DocumentModel;
use App\Repository\Document\Collection\DocumentCollection;
use App\Repository\Document\Contract\DocumentRepository;

class EloquentDocumentRepository implements DocumentRepository
{

    public function __construct(private DocumentModel $documentModel)
    {
    }

    public function getAll(): DocumentCollection
    {
        return new DocumentCollection(
          Document::arrayOf($this->documentModel->newQuery()->with(['category'])->get()->toArray())
        );
    }

    public function save(DocumentDTO $document): void
    {
        $this->documentModel->create($document->toArray());
    }
}
