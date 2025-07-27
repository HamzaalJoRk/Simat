<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['nationality_id', 'type', 'duration', 'entry_count', 'amount'];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
}
