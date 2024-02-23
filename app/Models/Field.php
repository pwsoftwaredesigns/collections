<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemField;
use Illuminate\Database\Eloquent\SoftDeletes;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Awobaz\Compoships\Compoships;

class Field extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasCompositeKey;
    use Compoships;

    //Need to use this syntax because of a 'bug' in the HasCompositeKey trait
    protected $primaryKey = ['collection_id'=>'collection_id', 'name'=>'name'];
    protected $fillable = ['collection_id', 'name', 'type', 'description'];

    public function fullName()
    {
        return $this->collection_id . '.' . $this->name;
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id', 'key');
    }
}
