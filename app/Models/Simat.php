<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simat extends Model
{
    protected $fillable = [
        'name',
        'mother_name',
        'nationality',
        'birth_date',
        'passport_number',
        'entry_date',
        'visa_type',
        'validity_duration',
        'fee_number',
        'fee_text',
        'country_code',
        'labor_fee',
        'serial_number'
    ];


    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($simat) {
            $simat->serial_number = self::generateSerialNumber();
        });
    }

    /**
     * Generate unique serial number
     */
    private static function generateSerialNumber()
    {
        $latest = self::latest('id')->first();
        $nextId = $latest ? $latest->id + 1 : 1;
        $startFrom = 5138;
        $serial = $startFrom + $nextId - 1;
        return str_pad($serial, 6, '0', STR_PAD_LEFT); 
    }

}
