<?php

namespace App\Providers;

use App\Repository\Document\Contract\DocumentRepository;
use App\Repository\Document\EloquentDocumentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DocumentRepository::class, EloquentDocumentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
