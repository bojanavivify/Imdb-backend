<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ElasticSearchService;


class ElasticSearchController extends Controller
{
    private $elasticSearchService;

    public function __construct(ElasticSearchService $elasticSearchService)
    {
       $this->elasticSearchService = $elasticSearchService;
    }

    public function index()
    {
       return response()->json($this->elasticSearchService->index());
    }

    public function reindex()
    {
        return response()->json($this->elasticSearchService->reindex());
    }

    public function search($title)
    {
        return response()->json($this->elasticSearchService->search($title));
    }

}

