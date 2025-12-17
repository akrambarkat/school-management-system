<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fees_Invoices extends Model
{

    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(classroom::class, 'classroom_id');
    }

    public function fees()
    {
        return $this->belongsTo(fees::class, 'fee_id');
    }

    public function receipts()
    {
        return $this->hasMany(ReceiptStudent::class, 'invoice_id');
    }

    public function studentAccounts()
{
    return $this->hasMany(Student_accounts::class, 'invoice_id');
}

}
