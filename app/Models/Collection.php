<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'key';
    public $incrementing = false;

    protected $fillable = [
        'key',
        'name',
        'description'
    ];
}
