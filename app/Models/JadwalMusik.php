<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMusik extends Model
{
    use HasFactory;

    protected $fillable = ['room', 'from', 'teacher_id', 'student_id', 'length'];


    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }


    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    // public function filterDate($date) {
    //     if ($date) return $this->whereDate('jadwal_musiks.from', '=', $date);
    //     return $this;
    // }

    // public function filterTeacher($teacher) {
    //     if ($teacher) return $this->where('jadwal_musiks.teacher_id', '=', $teacher);
    //     return $this;
    // }
}
