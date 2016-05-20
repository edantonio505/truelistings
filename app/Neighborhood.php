<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Property;

class Neighborhood extends Model
{
    protected $fillable = ['value', 'name', 'lat', 'lng'];




    public function currentNeighborhoods()
    {
    	$n = $this->all();
		
	   	foreach($n as $neighborhood)
	   	{
	   		$locations[] = Property::where('neighborhood', $neighborhood->name)->first();

	   		foreach($locations as $location)
	   		{
	   			if($location['neighborhood'] == $neighborhood->name)
	   			{
	   				$neighborhoods[] = $neighborhood->name;
	   			}
	   		}
	   	}



	   if(!isset($neighborhoods))
	   {
	   		$neighborhoods = [];
	   }
	   	return $neighborhoods;
    }
}
