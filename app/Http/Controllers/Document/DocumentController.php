<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Service\Document\DocumentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DocumentController extends Controller
{

    public function __construct(private DocumentService $service)
    {
    }

    public function index(): View
    {
        $documents = $this->service->getAll();
        return view('document.index', compact('documents'));
    }

    public function sendQueue(): RedirectResponse
    {
        $this->service->runQueue();

        return redirect()->route('documents.index');
    }
}
