<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstLocation extends Model
{
    use SoftDeletes;

    protected $table = 'mst_locations';
    protected $primaryKey = 'location_id';
    protected $fillable = ['name'];
}
