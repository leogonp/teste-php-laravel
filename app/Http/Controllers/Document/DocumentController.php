<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Service\Document\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function __construct(private DocumentService $service)
    {
    }

    public function index()
    {
        $documents = $this->service->getAll();
        dd($documents);

        return view('document.index', compact('documents'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Document $document)
    {
        //
    }
}
