<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowances extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "type",
        "from",
        "source_funds",
        "start_year",
        "end_year",
        "nominal",
    ];

}
