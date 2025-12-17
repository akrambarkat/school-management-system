<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class specialization extends Model
{
    function teacher()
    {
        return $this->hasMany(Techer::class);
    }

    function getTransNameAttribute()
    {
        return json_decode($this->name, true)[app()->getLocale()] ?? '';
    }
}
