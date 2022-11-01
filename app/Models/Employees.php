<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'user_id',
        'nip',
        'nik',
        'gender_id',
        'birth_place',
        'birth_date',
        'email_active',
        'religion',
        'address',
        'no_telp',
        'picture',
    ];

    public function genders() {
        return $this->belongsTo(Genders::class, 'gender_id');
    }

    public function user() {
        return $this->BelongsTo(User::class, "user_id");
    }

    public function incoming_mutations() {
        return $this->hashOne(Incoming_Mutations::class, "user_id");
    }

    public function exit_mutations() {
        return $this->hashOne(Exit_Mutations::class, "user_id");
    }

    public function familys() {
        return $this->belongsTo(Familys::class, 'user_id');
    }
}
