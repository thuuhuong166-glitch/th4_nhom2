<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','content','status','view_count','published_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'view_count'   => 'integer',
    ];

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status','published')
                 ->whereNotNull('published_at')
                 ->where('published_at','<=', Carbon::now());
    }
}
