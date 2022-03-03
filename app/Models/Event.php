<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Uuids, HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'name',
        'thumbnail',
        'content',
    ];
}
