<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familys extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'wedding_status_id', 'name', 'work', 'amount_child'];

    public function user() {
        return $this->BelongsTo(User::class, "user_id");
    }

    public function employees() {
        return $this->hashOne(Employees::class, "user_id");
    }

    public function wedding_status() {
        return $this->BelongsTo(Wedding_Status::class, "wedding_status_id");
    }
}
