<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserMemberships;

class MemberSessions extends Model
{
    /** @use HasFactory<\Database\Factories\MemberSessionsFactory> */
    use HasFactory;


    protected $fillable = ['user_membership_id', 'check_in', 'check_out'];


    public function userMembership(){
        return $this->belongsTo(UserMemberships::class);
    }
}
