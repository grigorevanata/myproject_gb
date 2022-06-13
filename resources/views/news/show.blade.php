<div>
    {{ $news['title'] }}
	<br />
	<img src="{{ Storage::disk('upload')->url($news['image']) }}" style="width:200px;"><br>

	<br>
	<p><strong>Автор:</strong> {{ $news['author'] }}</p>
	<p>{!! $news['description'] !!}</p>
</div>