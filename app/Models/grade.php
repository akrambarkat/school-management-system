<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    protected $fillable = [
        'name',
        'grade_id'
    ];

    public function fees()
    {
        return $this->hasMany(fees::class);
    }

    function ClassRoom()
    {
        return $this->hasMany(ClassRoom::class);
    }

    function sections()
    {
        return $this->hasMany(section::class);
    }
    public function students()
    {
        return $this->hasMany(student::class, 'grade_id');
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

    function getTransNotesAttribute()
    {
        return json_decode($this->notes, true)[app()->getLocale()] ?? '';
    }

    function getNotesEnAttribute()
    {
        return json_decode($this->notes, true)['en'] ?? '';
    }
    function getNotesArAttribute()
    {
        return json_decode($this->notes, true)['ar'] ?? '';
    }



    public function fromGrade()
    {
        return $this->belongsTo(grade::class, 'from_grade');
    }


    public function toGrade()
    {
        return $this->belongsTo(grade::class, 'to_grade');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
