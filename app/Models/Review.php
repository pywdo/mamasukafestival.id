<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Uuids, HasFactory;
    protected $table ="reviews";
    protected $fillable = [
        'rating',
        'comment',
        'courses_id',
        'username',
    ];
}
