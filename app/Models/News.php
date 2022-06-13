<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
		'category_id', 'title',
		'slug', 'author',
		'image', 'status',
		'description',
		'only_admin'
	];

	protected $casts = [
		'only_admin' => 'boolean'
	];


	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id',
		'id');
	}
	//scopes

	public function scopeActive($query)
	{
		return $query->where('status', 'ACTIVE');
	}

	public function scopeDraft($query)
	{
		return $query->where('status', 'DRAFT');
	}

	public function scopeBlocked($query)
	{
	return $query->where('status', 'BLOCKED');
	}


	public function sluggable(): array
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
}
