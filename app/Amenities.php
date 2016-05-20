<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    protected $fillable = [
	    'cats',
		'dogs',
		'dish_washer',
		'doorman1',
		'elevator1',
		'furnished',
		'gym',
		'pool',
		'laundry_unit1',
		'laundry_building1',
		'no_fee',
		'private_outdoor1',
		'common_outdoor',
		'central_ac',
		'fire_place',
		'childrens_playroom',
		'concierge',
		'live_in_super',
		'lounge',
		'parking',
		'storage_room'
    ];
	





     public function Property()
    {
        return $this->belongsTo('App\Property');
    }
}
