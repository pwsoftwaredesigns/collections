<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFieldValueText extends Model
{
    use HasFactory;
    use Compoships;
    protected $table = 'item_field_value_text';
    protected $fillable = ['collection_id', 'item_id', 'field_id', 'value'];
    public $timestamps = false;

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'key');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, ['collection_id','item_id'], ['collection_id','id']);
    }

    public function field()
    {
        return $this->belongsTo(Field::class, ['collection_id','field_id'], ['collection_id','name']);
    }
}
