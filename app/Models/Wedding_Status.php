<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding_Status extends Model
{
    use HasFactory;

    protected $table = 'wedding_statuses';

    public function familys() {
        return $this->hashOne(Familys::class, 'wedding_status_id');
    }
}
