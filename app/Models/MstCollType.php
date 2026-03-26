<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstCollType extends Model
{
    use SoftDeletes;

    protected $table = 'mst_coll_type';
    protected $primaryKey = 'coll_type_id';
    protected $fillable = ['name'];
}
