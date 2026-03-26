<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstSubject extends Model
{
    use SoftDeletes;

    protected $table = 'mst_subjects';
    protected $primaryKey = 'subject_id';
    protected $fillable = ['name'];
}
