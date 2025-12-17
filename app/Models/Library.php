<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $guarded = [];
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




    public function subject()
    {
        return $this->belongsTo(subject::class, 'teacher_id');
    }


    public function teacher()
    {
        return $this->belongsTo(Techer::class, 'teacher_id');
    }

    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(section::class, 'section_id');
    }
}
