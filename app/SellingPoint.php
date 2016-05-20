<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingPoint extends Model
{
    protected $fillable = [
	    'character',
        'chefs_kitchen',
        'closet_space',
        'doorman1',
        'elevator1',
        'laundry_building1',
        'laundry_unit1',
        'low_floor',
        'luxury_building',
        'modern',
        'natural_light',
        'newly_renovated',
        'prewar_details',
        'private_outdoor1',
        'proximity_subway',
        'quiet_peaceful',
        'views',
        'size'
    ];




     public function Property()
    {
        return $this->belongsTo('App\Property');
    }
}
