<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Property;
use App\Neighborhood;
use App\Helpers\PropertyDetails;

class ApiController extends Controller
{
    public function home()
    {	
    	$neighborhoods = Neighborhood::first()->currentNeighborhoods();
    	return response()->json(['neighborhoods' => $neighborhoods, 'selling_points' => $this->details(1)]);
    }


    public function search(Request $request)
    {
        $properties = Property::first()->getPropertiesFromSearch($request);
        $neighborhoods = Neighborhood::first()->currentNeighborhoods();
        $selected_wishes = array();
        
        foreach($this->details(1) as $s){
            if(
                $s['value'] == $request->input('gq1') || 
                $s['value'] == $request->input('gq2') || 
                $s['value'] ==$request->input('gq3')
            ){
                $selected_wishes[] = [$s['value'] => $s['key']];
            }
        }

        return response()->json([
            'neighborhoods' => $neighborhoods, 
            'amenities' => $this->details(2),
            'selling_points' => $this->details(1), 
            'properties' => $properties,
            'selected_wishes' => $selected_wishes
        ]);
    }



    private function details($type)
    {
        $d = new PropertyDetails();
        $details = ($type == 1 ? $d->sellingPoints : $d->amenities);
        return $details;
    }
}
