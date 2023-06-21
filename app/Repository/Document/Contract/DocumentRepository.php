<?php

namespace App\Repository\Document\Contract;

use App\DTO\Document\DocumentDTO;
use App\Repository\Document\Collection\DocumentCollection;

interface DocumentRepository
{
    public function getAll(): DocumentCollection;

    public function save(DocumentDTO $document): void;
}
