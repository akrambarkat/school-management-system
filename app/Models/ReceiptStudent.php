<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    protected $guarded = [];

    // العلاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    public function studentAccounts()
    {
        return $this->hasMany(Student_accounts::class, 'receipt_id');
    }
}
