<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = ['collection_id', 'id'];
    public $incrementing = false;

    protected $fillable = [
        'collection_id'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'key');
    }

    public function fields()
    {
        return $this->hasMany(ItemField::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->id = static::getNextId($model->collection_id);
        });
    }

    public static function getNextId($collection_id)
    {
        /*
        * A transaction is necessary to ensure that no race condition occurs
        * when two requests try to create a new item at the same time.
        */
        return DB::transaction(function () use ($collection_id)
        {
            $maxId = static::lockForUpdate()->where('collection_id', $collection_id)->max('id');
            return $maxId ? $maxId + 1 : 1;
        });
    }
}
