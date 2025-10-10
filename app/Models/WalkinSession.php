<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalkinSession extends Model
{
    /** @use HasFactory<\Database\Factories\WalkinSessionFactory> */
    use HasFactory;
    protected $fillable = ['name', 'check_in', 'check_out', 'amount_paid', 'payment_id'];

    public function payment(){
        return $this->belongsTo(Payments::class);
    }
}
