<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstPublisher extends Model
{
    use SoftDeletes;

    protected $table = 'mst_publishers';
    protected $primaryKey = 'publisher_id';
    protected $fillable = ['name'];
}
