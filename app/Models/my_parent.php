<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class my_parent extends Authenticatable
{
    protected $guarded = [];
    function nationality_father()
    {
        return $this->belongsTo(Nationalitie::class, 'Nationality_id')->withDefault();
    }

    function Religion_Father()
    {
        return $this->belongsTo(Religion::class, 'Religion_id')->withDefault();
    }

    public function students()
    {
        return $this->hasMany(student::class, 'parent_id');
    }
    function getTransNameAttribute()
    {
        return json_decode($this->Name, true)[app()->getLocale()] ?? '';
    }
    function getNameArAttribute()
    {
        return json_decode($this->Name, true)['ar'] ?? '';
    }

    function getNameEnAttribute()
    {
        return json_decode($this->Name, true)['en'] ?? '';
    }
}
