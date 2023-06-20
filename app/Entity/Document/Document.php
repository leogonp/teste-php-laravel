<?php

namespace App\Entity\Document;

use App\Enum\Document\DocumentCategoryEnum;

class Document
{

    public function __construct(
        private readonly string $title,
        private readonly DocumentCategoryEnum $categoryId,
        private readonly string $content,
    )
    {
    }

    public function toArray(): array
    {
        return [
          'title' => $this->title,
          'category_id' => $this->categoryId,
          'content' => $this->content,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            title: $data['title'],
            categoryId: DocumentCategoryEnum::from($data['category_id']),
            content: $data['content']
        );
    }

    public static function arrayOf(array $items): array
    {
        return array_map(fn (array $item) => self::fromArray($item), $items);
    }
}
