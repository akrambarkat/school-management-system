<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $guarded = [];

    public function fees()
    {
        return $this->hasMany(fees::class);
    }

    function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id')->withDefault();
    }
    function section()
    {
        return $this->hasMany(section::class);
    }
    public function students()
    {
        return $this->hasMany(student::class, 'classroom_id');
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


    public function fromClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'from_classRoom');
    }



    public function toClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'to_classRoom');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
