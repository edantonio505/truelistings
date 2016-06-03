<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Property;
use App\User;
use Auth;

class FeedController extends Controller
{
    public function parse()
    {	
    	$myXMLData = 'http://www.gzbrokers.com/index.php?option=com_iproperty&view=feed&layout=zillowtrulia&format=xml';
    	$xml = simplexml_load_file($myXMLData);
    	$properties = [];

    	foreach($xml as $p)
    	{	
    		$location = get_object_vars($p->location);
	    	$details = get_object_vars($p->details);
	    	$sale_type = get_object_vars($p);
	    	$detail_characteristics = get_object_vars($p->{'detailed-characteristics'});
	    	$exists = (array_key_exists('other-amenities', $detail_characteristics) ? true : false);
	    	$appliances = get_object_vars($p->{'detailed-characteristics'}->appliances);
	    	$other_amenities = get_object_vars($p->{'detailed-characteristics'}->{'other-amenities'});
	    	$pictures = json_encode($p->pictures);
			$picture = json_decode($pictures,TRUE);
			$user = get_object_vars($p->agent);

			if($user['agent-email'] === Auth::user()->email) {
				$property['address'] = $location['street-address'];
		    	$property['postal_code'] = ($location['zipcode'] ? $location['zipcode'] : '');
		    	$property['lng'] = $location['longitude'];
		    	$property['lat'] = $location['latitude'];
		    	$property['suite'] = (isset($location['unit-number'])? $location['unit-number']: '' );
		    	$property['slug'] = str_replace(' ', '-', preg_replace('/^([^,]*).*$/', '$1', $property['address']));
		    	$property['neighborhood'] = $location['city-name'];
		    	$property['ref'] = $details['mlsId'];
		    	$property['sale_type'] = $this->getSaleType($sale_type);
		    	$property['sale_sub_type'] = '';
		    	$property['price'] = intval($details['price']);
		    	$property['user_id'] = 1;
		    	$property['description'] = ($details['description'] ? $details['description'] : '');
		    	$property['beds'] = $details['num-bedrooms'];
		    	$property['baths'] = $this->getBathsValue($details['num-bathrooms']);
		    	$property['ft2'] = $details['square-feet'];
		    	$property['user_email'] = $user['agent-email'];
		    	$amenities['cats'] = 0;
		    	$amenities['dogs'] = 0;
		    	$amenities['dish_washer'] = ($appliances['has-dishwasher'] == 'Yes' ? 1 : 0);
		    	$amenities['doorman1'] = ($detail_characteristics['building-has-doorman'] == 'Yes' ? 1 : 0);
		    	$amenities['elevator1'] = ($detail_characteristics['building-has-elevator'] == 'Yes' ? 1 : 0);
		    	$amenities['furnished'] = 0;
		    	$amenities['gym'] = ($detail_characteristics['building-has-fitness-center'] == 'Yes' ? 1 : 0);
		    	$amenities['pool'] = ($detail_characteristics['has-pool'] == 'Yes' ? 1 : 0);
		    	$amenities['laundry_building1'] = ($this->getOtherAmenities($exists, $other_amenities, 'On-site Laundry') ? 1 : 0);
		    	$amenities['laundry_unit1'] = 0;
		    	$amenities['no_fee'] = ($details['fee'] == 'Yes' ? 1 : 0);
		    	$amenities['private_outdoor1'] = 0;
		    	$amenities['common_outdoor'] = ($detail_characteristics['has-patio'] == 'Yes' ? 1 : 0);
		    	$amenities['central_ac'] = ($this->getOtherAmenities($exists, $other_amenities, 'Central A/C') ? 1 : 0);
		    	$amenities['fire_place'] = ($detail_characteristics['has-fireplace'] == 'Yes' ? 1 : 0);
		    	$amenities['childrens_playroom'] = ($this->getOtherAmenities($exists, $other_amenities, "Children's Playroom") ? 1 : 0);
		    	$amenities['concierge'] = ($detail_characteristics['building-has-concierge'] == 'Yes' ? 1 : 0);
		    	$amenities['live_in_super'] = ($this->getOtherAmenities($exists, $other_amenities, "Live In Super") ? 1 : 0);
		    	$amenities['lounge'] = ($this->getOtherAmenities($exists, $other_amenities, "Lounge") ? 1 : 0);
		    	$amenities['parking'] = ($this->getOtherAmenities($exists, $other_amenities, "Parking") ? 1 : 0);
		    	$amenities['storage_room'] = 0;
		    	$property['amenities'] = $amenities;
		    	$property['photos'] = $this->getPhotos($property['slug'], $picture);
		    	$properties[] = $property;
			}

	    	
    	}
    	return response()->json($properties);
    }





    public function save_parsed()
    {	
    	set_time_limit(0);
    	$myXMLData = 'http://www.gzbrokers.com/index.php?option=com_iproperty&view=feed&layout=zillowtrulia&format=xml';
    	$xml = simplexml_load_file($myXMLData);

    	foreach($xml as $p)
    	{	
    		$location = get_object_vars($p->location);
	    	$details = get_object_vars($p->details);
	    	$sale_type = get_object_vars($p);
	    	$detail_characteristics = get_object_vars($p->{'detailed-characteristics'});
	    	$exists = (array_key_exists('other-amenities', $detail_characteristics) ? true : false);
	    	$appliances = get_object_vars($p->{'detailed-characteristics'}->appliances);
	    	$other_amenities = get_object_vars($p->{'detailed-characteristics'}->{'other-amenities'});
	    	$pictures = json_encode($p->pictures);
			$picture = json_decode($pictures,TRUE);
			$user = get_object_vars($p->agent);

			if($user['agent-email'] === Auth::user()->email) {
				if(Property::where('ref', $details['mlsId'])->count() == 0){
		    		$property = Property::create([
		    			'address' => $location['street-address'],
		    			'postal_code' => ($location['zipcode'] ? $location['zipcode'] : ''),
		    			'lng' => $location['longitude'],
		    			'lat' => $location['latitude'],
		    			'suite' => (isset($location['unit-number'])? $location['unit-number']: '' ),
				        'slug' => str_replace(' ', '-', preg_replace('/^([^,]*).*$/', '$1', $location['street-address'])),
				        'neighborhood' => $location['city-name'],
				        'ref' => $details['mlsId'],
				        'sale_type' => $this->getSaleType($sale_type),
				        'sale_sub_type' => '',
				        'price' => intval($details['price']),
				        'user_id' => Auth::user()->id,
				        'description' => ($details['description'] ? $details['description'] : ''),
				        'beds' => $details['num-bedrooms'],
				        'baths' => $this->getBathsValue($details['num-bathrooms']),
				        'ft2' => $details['square-feet']
		    		]);
		    		$property->SellingPoint()->create([
		    			'doorman1' => ($detail_characteristics['building-has-doorman'] == 'Yes' ? 1 : 0),
		    			'elevator1' => ($detail_characteristics['building-has-elevator'] == 'Yes' ? 1 : 0),
		    			'laundry_building1' => ($this->getOtherAmenities($exists, $other_amenities, 'On-site Laundry') ? 1 : 0)
		    		]);

		    		$property->Amenities()->create([
			            'cats' => 0,
			            'dogs' => 0,
			            'dish_washer' => ($appliances['has-dishwasher'] == 'Yes' ? 1 : 0),
			            'doorman1' => ($detail_characteristics['building-has-doorman'] == 'Yes' ? 1 : 0),
			            'elevator1' => ($detail_characteristics['building-has-elevator'] == 'Yes' ? 1 : 0),
			            'furnished' => 0,
			            'gym' => ($detail_characteristics['building-has-fitness-center'] == 'Yes' ? 1 : 0),
			            'pool' => ($detail_characteristics['has-pool'] == 'Yes' ? 1 : 0),
			            'laundry_unit1' => 0,
			            'laundry_building1' => ($this->getOtherAmenities($exists, $other_amenities, 'On-site Laundry') ? 1 : 0),
			            'no_fee' => ($details['fee'] == 'Yes' ? 0 : 1),
			            'private_outdoor1' => 0,
			            'common_outdoor' => ($detail_characteristics['has-patio'] == 'Yes' ? 1 : 0),
			            'central_ac' => ($this->getOtherAmenities($exists, $other_amenities, 'Central A/C') ? 1 : 0),
			            'fire_place' => ($detail_characteristics['has-fireplace'] == 'Yes' ? 1 : 0),
			       'childrens_playroom' => ($this->getOtherAmenities($exists, $other_amenities, "Children's Playroom") ? 1 : 0),
			            'concierge' => ($detail_characteristics['building-has-concierge'] == 'Yes' ? 1 : 0),
			            'live_in_super' => ($this->getOtherAmenities($exists, $other_amenities, "Live In Super") ? 1 : 0),
			            'lounge' => ($this->getOtherAmenities($exists, $other_amenities, "Lounge") ? 1 : 0),
			            'parking' => ($this->getOtherAmenities($exists, $other_amenities, "Parking") ? 1 : 0),
			            'storage_room' => 0
			        ]);

					$photos = $this->getPhotos($property['slug'], $picture);

					if($photos != '')
					{
						foreach($photos as $photo)
						{
							$property->photos()->create([
								'initial_property_id' => Auth::user()->name.$photo['initial_property_id'],
								'path' => $photo['path'],
								'thumbnail_path' => $photo['thumbnail_path'],
								'property_id' => $property->id
							]);
						}
					}
				}
			}
    	}

    	return redirect()->back();
    }










    // --------------------------------------functions to parse--------------------------------------

    public function getOtherAmenities($exists, $other_amenities, $amenity){
    	if($exists === true && is_array($other_amenities['other-amenity'])){
    		if(in_array($amenity, $other_amenities['other-amenity'])){
    			return true;
    		}
    	} 
    	return false;
    }



    public function getSaleType($sale_type)
    {
    	if(array_key_exists('status', $sale_type)){
    		if($sale_type['status'] === 'For Rent')
    		{
    			return 'rent';
    		} else {
    			return 'sale';
    		}
    	}	
    	return '';
    }



    public function getBathsValue($num_bathrooms)
    {	
    	switch ($num_bathrooms) {
		    case "1.00":
		        return 1;
		        break;
		    case "1.50":
		    	return 15;
		    	break;
		    case "2.00":
		        return 2;
		        break;
		    case "2.50":
		    	return 25;
		    	break;
		    case "3.00":
		        return 3;
		        break;
		    case "3.50":
		    	return 35;
		    case "4.00":
		    	return 4;
		    	break;
		    case "4.50":
		    	return 45;
		    	break;
		    case "5.00":
		    	return 5;
		    	break;
		    case "5.50":
		    	return 55;
		    	break;
		    default:
		    	return intval($num_bathrooms);
		}
    }


    public function getPhotos($slug, $photos){
    	$pictures = [];
    	if(array_key_exists('picture', $photos)){
			foreach($photos['picture'] as $photo){
	    		$picture['path'] = (is_array($photo) ? $photo['picture-url'] : '');
	    		$picture['thumbnail_path'] = (is_array($photo) ? $photo['picture-url'] : '');
	    		$picture['initial_property_id'] = $slug;
	    		$pictures[] = $picture;
	    	}
	    	return $pictures;
	    }

	    return '';
    }
}
