<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $guarded = [];


    public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}

public function quizze()
{
    return $this->belongsTo(Quizze::class, 'quizze_id');
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
}

