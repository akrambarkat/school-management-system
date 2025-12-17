<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fees extends Model
{
    protected $guarded = [];
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * علاقة مع الفصل الدراسي (ClassRoom).
     */
    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
    function getTransNameAttribute()
    {
        return json_decode($this->title, true)[app()->getLocale()] ?? '';
    }

    function getNameArAttribute()
    {
        return json_decode($this->title, true)['ar'] ?? '';
    }

    function getNameEnAttribute()
    {
        return json_decode($this->title, true)['en'] ?? '';
    }
}
