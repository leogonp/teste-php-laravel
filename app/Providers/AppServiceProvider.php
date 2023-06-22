<?php

namespace App\Providers;

use App\Job\ProcessDocument;
use App\Repository\Document\Contract\DocumentRepository;
use App\Repository\Document\EloquentDocumentRepository;
use App\Service\Document\DocumentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DocumentRepository::class, EloquentDocumentRepository::class);

        $this->app->bindMethod([ProcessDocument::class, 'handle'], function (ProcessDocument $job, Application $app) {
            return $job->handle($app->make(DocumentService::class));
        });
    }

    public function boot(): void
    {
        //
    }
}
