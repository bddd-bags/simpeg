<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_Experiences extends Model
{
    use HasFactory;

    protected $table = 'job_experiences';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'place_id',
        'start_year',
        'end_year',
    ];

    public function places() {
        return $this->belongsTo(Places::class, 'place_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
