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
    protected $casts = ['check_in' => 'datetime', 
    'check_out' => 'datetime'];


    public function userMembership(){
        return $this->belongsTo(UserMemberships::class);
    }
    public function user(){
    return $this->hasOneThrough(
        User::class,
        UserMemberships::class,
        'id',                 // Foreign key on user_memberships
        'id',                 // Foreign key on users
        'user_membership_id', // Local key on member_sessions
        'user_id'             // Local key on user_memberships
    );
}
}
