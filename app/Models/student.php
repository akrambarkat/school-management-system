<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class student extends Authenticatable
{
    protected $guard = 'student';
    protected $table = 'students'; // تأكد من اسم الجدول
    protected $hidden = [
        'password',
        'remember_token',
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at']; // يُستخدم لتحديد عمود الحذف

    protected $guarded = [];
    public function gender()
    {
        return $this->belongsTo(gender::class);
    }

    public function religion()
    {
        return $this->belongsTo(religion::class);
    }
    public function nationality()
    {
        return $this->belongsTo(Nationalitie::class, 'Nationality_id');
    }

    public function grade()
    {
        return $this->belongsTo(grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(classroom::class);
    }

    public function section()
    {
        return $this->belongsTo(section::class);
    }

    public function parent()
    {
        return $this->belongsTo(my_parent::class, 'parent_id');
    }


    function getTransNameAttribute()
    {
        return json_decode($this->name, true)[app()->getLocale()] ?? '';
    }


    function getNameArAttribute()
    {
        return json_decode($this->name, true)['ar'] ?? '';
    }

    function getNameEnAttribute()
    {
        return json_decode($this->name, true)['en'] ?? '';
    }


    public function image()
    {
        return $this->morphMany(image::class, 'imageable');
    }


    public function promotion()
    {
        return $this->belongsTo(promotion::class);
    }


    public function student_account()
    {
        return $this->hasMany(Student_accounts::class, 'student_id');
    }

    public function processingFees()
    {
        return $this->hasMany(ProcessingFee::class);
    }

    public function paymentstudent()
    {
        return $this->hasMany(paymentstudent::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function fees()
    {
        return $this->hasManyThrough(
            \App\Models\fees::class,
            \App\Models\Fees_Invoices::class,
            'student_id',    // العمود الموجود في جدول fees__invoices الذي يربطه بالطالب
            'id',            // العمود في جدول fees الذي يربطه بجدول fees__invoices
            'id',            // المفتاح الأساسي في جدول الطلاب
            'fee_id'         // العمود في جدول fees__invoices الذي يشير إلى جدول fees
        );
    }

    public function feeInvoices()
    {
        return $this->hasMany(Fees_Invoices::class, 'student_id');
    }

    public function receipts()
    {
        return $this->hasMany(ReceiptStudent::class);
    }
}
