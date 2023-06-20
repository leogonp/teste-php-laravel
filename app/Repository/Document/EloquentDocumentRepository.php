<?php

namespace App\Repository\Document;

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
          Document::arrayOf($this->documentModel::all()->toArray())
        );
    }
}
