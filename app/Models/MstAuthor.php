<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstAuthor extends Model
{
    use SoftDeletes;

    protected $table = 'mst_authors';
    protected $primaryKey = 'author_id';
    protected $fillable = ['name'];
}
