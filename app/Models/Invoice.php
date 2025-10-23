<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'invoice_number',
        'invoice_date',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
