<?php

namespace App\Http\Controllers;

use App\Queries\QueryBuilderNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(QueryBuilderNews $builderNews)
	{
		return view('news.index', [
			'newsList' => $builderNews->getNews()
		]);
	}

	public function show(string $slug, QueryBuilderNews $builderNews)
	{
		dd($builderNews->getNewsBySlug($slug)->first());
		return view('news.show', [
			'news' => $builderNews->getNewsBySlug($slug)->first()
		]);
	}
}
