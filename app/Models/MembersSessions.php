<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembersSessions extends Model
{

    protected $fillable = [
        'check_in',
        'check_out',
        'is_in',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    /** @use HasFactory<\Database\Factories\MembersSessionsFactory> */
    use HasFactory;
}
