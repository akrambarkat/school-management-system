<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{

    protected $guarded = [];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function fromClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'from_classRoom');
    }

    public function toClassRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'to_classRoom');
    }

    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }

    // Helper Methods
    public function promotionDetails()
    {
        return [
            'student' => $this->student->name,
            'from' => [
                'grade' => $this->fromGrade->name,
                'classRoom' => $this->fromClassRoom->name,
                'section' => $this->fromSection->name,
            ],
            'to' => [
                'grade' => $this->toGrade->name,
                'classRoom' => $this->toClassRoom->name,
                'section' => $this->toSection->name,
            ],
        ];
    }

    public static function createPromotion($data)
    {
        return self::create($data);
    }

    public function updatePromotion($data)
    {
        return $this->update($data);
    }

    public function deletePromotion()
    {
        return $this->delete();
    }
}
