<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exit_Mutations extends Model
{
    use HasFactory;

    protected $table = 'exit_mutations';

    protected $fillable = ['user_id', 'purpose_moving', 'position'];

    // public function user() {
    //     return $this->BelongsTo(User::class, "user_id");
    // }

    public function employees() {
        return $this->BelongsTo(Employees::class, 'user_id');
    }
}
