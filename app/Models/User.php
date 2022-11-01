<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function employees() {
        return $this->hashOne(Employees::class, 'user_id');
    }

    public function familys() {
        return $this->hashOne(Familys::class, 'user_id');
    }

    public function welfares() {
        return $this->hasMany(Welfares::class);
    }

    public function educations() {
        return $this->hasMany(Educations::class);
    }

    public function job_experiences() {
        return $this->hasMany(Job_Experiences::class);
    }

    public function incoming_mutations() {
        return $this->hashOne(Incoming_Mutations::class, 'user_id');
    }

    public function exit_mutations() {
        return $this->hashOne(Exit_Mutations::class, 'user_id');
    }

    public function trainings() {
        return $this->hashOne(Trainings::class, 'user_id');
    }
}
