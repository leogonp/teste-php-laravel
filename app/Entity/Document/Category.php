<?php

namespace App\Entity\Document;

use App\Enum\Document\DocumentCategoryEnum;

class Category
{

    public function __construct(
        public readonly int $id,
        public readonly string $name,
    )
    {
    }

    public function toArray(): array
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
        ];
    }

    public static function fromArray(array $data): static
    {
        return new static(
            id: $data['id'],
            name: $data['name']
        );
    }

    public static function arrayOf(array $items): array
    {
        return array_map(fn (array $item) => self::fromArray($item), $items);
    }
}
