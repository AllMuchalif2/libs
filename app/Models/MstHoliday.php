<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstHoliday extends Model
{
    use SoftDeletes;

    protected $table = 'mst_holidays';
    protected $primaryKey = 'holiday_id';
    protected $fillable = ['holiday_date', 'description'];
}
