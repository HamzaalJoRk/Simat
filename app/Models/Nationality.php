<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['name'];

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function simats()
    {
        return $this->hasMany(Simat::class, 'nationality_id');
    }
}
