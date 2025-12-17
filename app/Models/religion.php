<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class religion extends Model
{
    protected $guarded = [];
    function my_parent()
    {
        return $this->hasMany(Nationalitie::class);
    }
    public function students()
    {
        return $this->hasMany(student::class, 'religion_id');
    }

    function getTransNameAttribute()
    {
        return json_decode($this->name, true)[app()->getLocale()] ?? '';
    }
}
