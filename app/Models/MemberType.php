<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member_types';
    protected $primaryKey = 'member_type_id';

    protected $fillable = [
        'name',
        'loan_limit',
        'loan_duration',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'member_type_id', 'member_type_id');
    }
}
