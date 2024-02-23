<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Item extends Model
{
    use HasFactory;
    use HasCompositeKey;
    use Compoships;

    protected $primaryKey = ['collection_id'=>'collection_id', 'id'=>'id'];
    public $incrementing = false;

    protected $fillable = [
        'collection_id'
    ];

    public function fullId()
    {
        return $this->collection_id . '-' . $this->id;
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'key');
    }

    public function fieldValues()
    {
        return $this->hasMany(ItemFieldValueText::class, ['collection_id', 'item_id'], ['collection_id', 'id']);
    }

    public static function boot()
    {
        parent::boot();

        /*
        * When creating a new item, we need to set the id to the next available
        * id for the collection. We can't simply use an auto-incrementing id
        * because we want the ID to start from 1 for each collection.
        * We use the creating event to set the id before the item is created.
        */
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
