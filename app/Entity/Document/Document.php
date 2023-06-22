<?php

namespace App\Entity\Document;

class Document
{

    public function __construct(
        public readonly string $title,
        public readonly string $contents,
        public readonly Category $category,
    )
    {
    }

    public function toArray(): array
    {
        return [
          'title' => $this->title,
          'contents' => $this->contents,
          'category' => $this->category->toArray(),
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            title: $data['title'],
            contents: $data['contents'],
            category: Category::fromArray($data['category'])
        );
    }

    public static function arrayOf(array $items): array
    {
        return array_map(fn (array $item) => self::fromArray($item), $items);
    }
}
