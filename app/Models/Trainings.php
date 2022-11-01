<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'type', 'organizer', 'year', 'status'];
    
    public function user() {
        return $this->BelongsTo(User::class, "user_id");
    }

}
