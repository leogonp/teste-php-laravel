<?php

namespace App\Enum\Document;

enum DocumentCategoryEnum: int
{
    case PARTIAL_SHIPPING = 1;
    case SHIPPING = 2;

    public static function fromString(string $category): self
    {
        return match ($category) {
            'Remessa Parcial' => self::PARTIAL_SHIPPING,
            'Remessa' => self::SHIPPING,
        };
    }
}
