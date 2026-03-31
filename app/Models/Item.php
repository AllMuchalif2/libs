<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'biblio_id',
        'item_code',
        'location_id',
        'coll_type_id',
        'status',
        'call_number',
    ];

    public function biblio()
    {
        return $this->belongsTo(Biblio::class, 'biblio_id', 'biblio_id');
    }

    public function location()
    {
        return $this->belongsTo(MstLocation::class, 'location_id', 'location_id');
    }

    public function collType()
    {
        return $this->belongsTo(MstCollType::class, 'coll_type_id', 'coll_type_id');
    }
}
