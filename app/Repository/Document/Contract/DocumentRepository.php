<?php

namespace App\Repository\Document\Contract;

use App\Repository\Document\Collection\DocumentCollection;

interface DocumentRepository
{
    public function getAll(): DocumentCollection;
}
