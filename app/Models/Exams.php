<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
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
}
