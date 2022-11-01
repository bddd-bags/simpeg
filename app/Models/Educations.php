<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "last_education",
        "education_stage",
        "field_study",
        "college_name",
        "graduation_year"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
