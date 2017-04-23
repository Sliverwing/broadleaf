<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'is_direct_link',
        'is_top',
        'intro',
        'views_count',
        'banner',
        'reference_link',
        'content',
        'user_id',
        'category_id'
    ];
}
