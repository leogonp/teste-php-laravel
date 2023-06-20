<?php

namespace App\Service\Document;

use App\Repository\Document\Contract\DocumentRepository;

class DocumentService
{

    public function __construct(private DocumentRepository $repository)
    {
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
}
