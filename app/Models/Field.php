<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemField;

class Field extends Model
{
    use HasFactory;
    protected $fillable = ['collection_id', 'name', 'type', 'description'];

    public function itemFields()
    {
        return $this->hasMany(ItemField::class);
    }
}
