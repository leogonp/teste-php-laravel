<?php

namespace App\Repository\Document\Collection;

use App\Entity\Document\Document;
use Illuminate\Support\Collection;

class DocumentCollection extends Collection
{
    protected string $allowedType = Document::class;

    public function toArray(): array
    {
        return array_map(fn (Document $item) => $item->toArray(), parent::toArray());
    }

}
