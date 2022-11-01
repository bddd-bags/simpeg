<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming_Mutations extends Model
{
    use HasFactory;

    protected $table = 'incoming_mutations';

    protected $fillable = ['user_id', 'from', 'position'];

    // public function user() {
    //     return $this->BelongsTo(User::class, "user_id");
    // }

    public function employees() {
        return $this->BelongsTo(Employees::class, 'user_id');
    }
}
