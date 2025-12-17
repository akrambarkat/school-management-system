<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student_accounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_invoices_id',
        'student_id',
        'grade_id',
        'classroom_id',
        'Debit',
        'credit',
        'description',
    ];

    // العلاقة مع الفاتورة (الرسوم)
    public function feeInvoice()
    {
        return $this->belongsTo(fees::class, 'fee_invoices_id');
    }

    // العلاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    public function receipt()
    {
        return $this->belongsTo(ReceiptStudent::class, 'receipt_id');
    }

    // العلاقة مع الصف الدراسي
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    // العلاقة مع الفصل الدراسي
    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }
}
