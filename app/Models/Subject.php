<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'student_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'teacher_id',
        'attendence_date',
        'attendence_status'
    ];


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

    // العلاقة مع الطلاب
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }

    // العلاقة مع المعلمين
    public function teacher()
    {
        return $this->belongsTo(Techer::class, 'teacher_id');
    }

    // العلاقة مع الصفوف الدراسية
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    // العلاقة مع الفصول الدراسية
    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }

    // العلاقة مع الأقسام

}
