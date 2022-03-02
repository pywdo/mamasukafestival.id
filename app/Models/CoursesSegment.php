<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesSegment extends Model
{
    use Uuids, HasFactory;

    protected $table = 'courses_segment';

    protected $fillable = [
        'name',
        'embed',
        'ordering',
        'courses_id',
    ];
}
