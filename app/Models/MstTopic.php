<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstTopic extends Model
{
    use SoftDeletes;

    protected $table = 'mst_topics';
    protected $primaryKey = 'topic_id';
    protected $fillable = ['name'];
}
