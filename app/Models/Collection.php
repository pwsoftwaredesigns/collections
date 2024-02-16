<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\field\Field;
use App\Models\Item;

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

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class, "collection_id", "key");
    }
}
