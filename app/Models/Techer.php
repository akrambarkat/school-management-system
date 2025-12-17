<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Techer extends Authenticatable
{
    protected $guarded = [];

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_techer', 'teacher_id', 'section_id');
    }

    function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
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


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
