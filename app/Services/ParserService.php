<?php

namespace App\Services;


use App\Services\Contract\Parser;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{
    protected string $link;

	public function setLink(string $link): Parser
    {
        $this->link = $link;

		return $this;
    }

    public function parse(): array
	{
		$xml = XmlParser::load($this->link);

		return $xml->parse([
			'title' => [
				'uses' => 'channel.title'
			],
			'link' => [
				'uses' => 'channel.link'
			],
			'description' => [
				'uses' => 'channel.description'
			],
			'image' => [
				'uses' => 'channel.image.url'
			],
			'lastBuildDate' => [
				'uses' => 'lastBuildDate'
			],
			'news' => [
				'uses' => 'channel.item[title,link,guid,description,pubDate]'
			]
		]);

		$e = explode("/", $this->link);
		$fileName = end($e);

		$jsonEncode = json_encode($data);

		Storage::append('news/' . $fileName, $jsonEncode);
	}
}