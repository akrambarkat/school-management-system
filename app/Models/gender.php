<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gender extends Model
{
    //
    function teacher()
    {
        return $this->hasMany(Techer::class);
    }

    public function students()
    {
        return $this->hasMany(student::class, 'gender_id');
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
