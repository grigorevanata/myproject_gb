<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contract\Parser;
use Illuminate\Http\Request;


class ParserController extends Controller
{
    public function __invoke(Request $request, Parser $parser)
    {
        
        dd(
            $parser->setlink('https://news.yandex.ru/business.rss')
            ->parse()
        );
    }
}
