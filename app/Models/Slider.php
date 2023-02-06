<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use Uuids, HasFactory;
    protected $table = 'slider';

    protected $fillable = [
        'name',
        'thumbnail',
        'content',
    ];
}
