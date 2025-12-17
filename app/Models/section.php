<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(Techer::class, 'section_techer', 'section_id', 'teacher_id');
    }



    function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id')->withDefault();
    }
    function class_room()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id')->withDefault();
    }

    public function students()
    {
        return $this->hasMany(student::class, 'section_id');
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


    public function fromSection()
    {
        return $this->belongsTo(section::class, 'from_section');
    }
    public function toSection()
    {
        return $this->belongsTo(section::class, 'to_section');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
