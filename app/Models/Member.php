<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'members';
    protected $primaryKey = 'member_id';

    protected $fillable = [
        'nim',
        'password',
        'member_type_id',
        'name',
        'gender',
        'faculty',
        'study_program',
        'whatsapp_number',
        'address',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    public function memberType()
    {
        return $this->belongsTo(MemberType::class, 'member_type_id', 'member_type_id');
    }
}
