<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = [
        'student_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'teacher_id',
        'attendence_date',
        'attendence_status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public function grade()
    {
        return $this->belongsTo(grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function section()
    {
        return $this->belongsTo(section::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Techer::class);
    }
}
