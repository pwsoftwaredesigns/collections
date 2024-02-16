<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFieldValueText extends Model
{
    use HasFactory;
    protected $fillable = ['item_field_id', 'value'];
    protected $timestamps = false;

    public function itemField()
    {
        return $this->belongsTo(ItemField::class);
    }
}
