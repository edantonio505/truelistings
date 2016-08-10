<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Property;
use App\Neighborhood;
use App\Helpers\PropertyDetails;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    public function home()
    {	
    	$neighborhoods = Neighborhood::first()->currentNeighborhoods();
    	return response()->json(['neighborhoods' => $neighborhoods, 'selling_points' => $this->details(1)]);
    }


    public function search(Request $request)
    {   
        $path = 'api/v1/search?min='.$request->input('min').'&max='.$request->input('max').'&location='.$request->input('location').'&beds='.$request->input('beds').'&gq1='.$request->input('gq1').'&gq2='.$request->input('gq2').'&gq3='.$request->input('gq3');
        
        $properties = $this->paginate(Property::first()->getPropertiesFromSearch($request))->setPath($path);
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



   
    public function getUserInfo($id)
    {
        $u = User::findOrFail($id);
        $user['name'] = $u->name;
        $user['email'] = $u->email;
        $user['avatar'] = $u->getAvatarProfileUrl();
        return response()->json(['user' => $user]);
    }


    // ------------------------------Paginator--------------------------
    protected function paginate($items, $perPage = 12)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($items, ($currentPage - 1) * $perPage, $perPage);
        return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    }

     private function details($type)
    {
        $d = new PropertyDetails();
        $details = ($type == 1 ? $d->sellingPoints : $d->amenities);
        return $details;
    }
}
