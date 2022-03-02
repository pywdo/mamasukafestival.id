<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use Uuids, HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'thumbnail',
        'price',
        'category_id',
        'description',
    ];
}
