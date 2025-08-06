<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'name',
        'vehicle_type',
        'model',
        'chassis_number',
        'plate_number',
        'start_date',
        'serial_number',
        'end_date',
        'duration',
        'amount_numeric',
        'amount_written',
        'type',
        'notes'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($insurance) {
            $insurance->serial_number = self::generateSerialNumber();
        });
    }

    /**
     * Generate unique serial number
     */
    private static function generateSerialNumber()
    {
        $latest = self::latest('id')->first();
        $nextId = $latest ? $latest->id + 1 : 1;
        $startFrom = 1903;
        $serial = $startFrom + $nextId - 1;
        return str_pad($serial, 6, '0', STR_PAD_LEFT);
    }
}
