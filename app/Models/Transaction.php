<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuids, HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'courses_id',
        'proof',
        'status',
        'note',
        'user_id',
    ];
}
