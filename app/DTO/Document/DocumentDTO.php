<?php

namespace App\DTO\Document;

use App\Enum\Document\DocumentCategoryEnum;

class DocumentDTO
{

    public function __construct(
        public readonly string $title,
        public readonly DocumentCategoryEnum $categoryId,
        public readonly string $contents,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'category_id' => $this->categoryId->value,
            'contents' => $this->contents,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            title: $data['titulo'],
            categoryId: DocumentCategoryEnum::fromString($data['categoria']),
            contents: $data['conteúdo'],
        );
    }
}
