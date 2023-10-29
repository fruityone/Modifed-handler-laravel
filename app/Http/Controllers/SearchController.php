<?php

namespace App\Http\Controllers;


use App\Http\Requests\SearchRequest;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function index(SearchRequest $request , SearchService $searchService)
    {
        $query = $request->input('query');
        $searchData=$searchService->getSearchData($query);
        return response()->json([$searchData]);
    }
}
