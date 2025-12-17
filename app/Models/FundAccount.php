<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    protected $guarded = [];
    public function receipt()
    {
        return $this->belongsTo(ReceiptStudent::class, 'receipt_id');
    }
}
