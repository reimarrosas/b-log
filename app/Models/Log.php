<?php

namespace App\Models;

use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'description',
        'logbook_id'
    ];

    /**
     * Get the Log Description
     *
     * @param  string  $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return Purify::clean($value);
    }

    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }
}
