<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    use HasFactory;

    // Allowed mass assignment fields
    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    // Relationship: satu loket memiliki banyak antrian
    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }
}
