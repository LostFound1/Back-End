<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'desc',
        'location',
        'city',
        'type_place',
        'image',
        'user_id',
        'category_id',
    ];
}
