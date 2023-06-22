<?php

namespace Tests\Unit\Enum\Document;

use App\Enum\Document\DocumentCategoryEnum;
use PHPUnit\Framework\TestCase;

class DocumentCategoryEnumTest extends TestCase
{
    public function testShouldCreateEnumFromStringCorrectly(): void
    {
        $partialShipping = DocumentCategoryEnum::fromString('Remessa Parcial');
        $shipping = DocumentCategoryEnum::fromString('Remessa');

        $this->assertEquals(DocumentCategoryEnum::PARTIAL_SHIPPING, $partialShipping);
        $this->assertEquals(DocumentCategoryEnum::SHIPPING, $shipping);
    }
}
