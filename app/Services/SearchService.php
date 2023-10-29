<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Blog;

/**
 * Class SearchService.
 */
class SearchService
{
    public function getSearchData($query)
    {
        $blogs = Blog::where('description', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orWhere('tags', 'LIKE', "%$query%")
            ->get();

        $articles = Article::where('description', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->orWhere('tags', 'LIKE', "%$query%")
            ->orWhereHas('blog', function ($queryBuilder) use ($query) {
                $queryBuilder->where('description', 'LIKE', "%$query%")
                    ->orWhere('name', 'LIKE', "%$query%");
            })
            ->paginate(10);
        return [$blogs, $articles];
    }
}
