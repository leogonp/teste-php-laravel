<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'category_id',
      'contents',
    ];

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }
}
