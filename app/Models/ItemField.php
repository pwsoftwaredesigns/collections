<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemField extends Model
{
    use HasFactory;
    protected $fillable = ['item_id', 'field_id', 'value'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
