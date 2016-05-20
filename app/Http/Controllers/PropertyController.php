<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Neighborhood;
use Auth;
use App\Property;
use Elasticsearch\ClientBuilder;
use App\Photo;
use File;
use App\SellingPoint;



class PropertyController extends Controller
{
	// ------------------------------Adding New Property-----------------------------
    public function newProperty()
	{	
		if(!Auth::user()->checkIsBroker())
		{
			return redirect()->route('home');
		}
		$neighborhoods = Neighborhood::all();
		return view('property.new', ['neighborhoods'=>$neighborhoods]);
	}

	public function upload_photo(Request $request)
	{	
		Property::first()->createPhotos($request);
		if($request->input('property_id') != '')
		{
			$this->index(Property::findOrFail($request->input('property_id')));
		}
	}

	public function delete_photo($photo_id)
	{
		$photo = Photo::findOrFail($photo_id);
		File::delete($photo->path, $photo->thumbnail_path);
		$p = Property::findOrFail($photo->property_id);
		$photo->delete();
		$this->index($p);
	}

	public function postNewProperty(Request $request)
	{	
		$this->validate($request, [
	        'address' => 'required',
	        'postal_code' => 'required|numeric',
        	'neighborhood' => 'required',
        	'price' => 'required'
	    ]);
		$p = Property::create($request->input());
		$p->savePicture($request);
		$p->Amenities()->create($request->input());
		$p->SellingPoint()->create($request->input());
		$this->index($p);
		session()->flash('flash_message', 'You have created a New Property');
		return redirect()->route('dashboard');
	}
	// ------------------------------------------------------------------------------



	//-----------------------------Edit a Property information------------------------
	public function saveOnTheFly(Request $request)
	{
		$p = Property::findOrFail($request->input('property_id'));
		$p->updateSellingPoint($request);
		if($p->checkIfHasSellingPoints() == "SellingPointIncomplete"){
			$this->delete_document($p);
			return $p->checkIfHasSellingPoints();
		}
		$this->index($p);
	}

	public function saveEditedProperty(Request $request)
	{	
		$p = Property::findOrFail($request->input('property_id'));
		$p->updateProperty($request);
		$this->index($p);
	}

	public function editProperty($id)
	{
		$property = Property::findOrFail($id);
		$neighborhoods = Neighborhood::all();

		return view('property.edit', [
			'neighborhoods' => $neighborhoods,
			'property' => $property]);
	}


	public function postEditProperty($id, Request $request)
	{	
		$this->validate($request, [
	        'address' => 'required',
	        'postal_code' => 'required|numeric',
        	'neighborhood' => 'required',
        	'price' => 'required'
	    ]);
		$p = Property::findOrFail($id);
		$p->updateProperty($request);
		$this->index($p);
		session()->flash('flash_message', 'You have edited your property');
		return redirect()->route('dashboard');
	}


	public function deleteProperty(Request $request)
	{	
		$property = Property::findOrFail($request->input('id'));
		$this->delete_document($property);
		$property->delete();
		return 'deleted';
	}
	//-----------------------------------------------------------------------------








	// ------------------------------Searching a Property-----------------------------
	public function search(Request $request)
	{	
		$this->validate($request, [
			'min' => 'required',
			'location'=>'required',
	        'gq1' => 'required',
        	'gq2' => 'required',
        	'gq3' => 'required'
	    ],[
	    "min.required" => "The price range field is required",
        "gq1.required" =>"The 'cant live without' field is required", 
        "gq2.required" => "The 'really, really want' field is required",
        "gq3.required" => "The 'I wish it would have' field is required"]);
		$query = $request;
		$neighborhoods = Neighborhood::first()->currentNeighborhoods();
		$properties = Property::first()->getPropertiesFromSearch($request);	
		return view('search.results')
			->withProperties($properties)
			->withQuery($query)
			->withNeighborhoods($neighborhoods);
	}
	// ----------------------------------------------------------------------------

	private function Elasticsearch()
	{
		$client = ClientBuilder::create()->build();
		return $client;
	}

	private function delete_document(Property $p)
	{
		$client = $this->Elasticsearch();
		$params = [
		    'index' => 'truelistings',
		    'type' => 'property',
		    'id' => $p->id
		];

		// Delete doc at /my_index/my_type/my_id
		$response = $client->delete($params);
	}


	private function index(Property $p)
	{	
		$client = $this->Elasticsearch();
		$params = [
		    'index' => 'truelistings',
		    'type' => 'property',
		    'id' => $p->id,
		    'body' => [
		    	'address' => $p->address,
		    	'location'=> $p->lat.", ". $p->lng,
		        'postal_code' => $p->postal_code,
		        'slug' => $p->slug,
		        'neighborhood' => $p->neighborhood,
		        'price' => $p->price,
		        'user_id' => $p->user_id,
		        'description' => $p->description,
		        'beds' => $p->beds,
		        'baths' => $p->baths,
		        'thumbnail' => $p->thumbnail(),
		        'selling_points' => [
		        	'character' => $p->SellingPoint->character,
			        'chefs_kitchen' => $p->SellingPoint->chefs_kitchen,
			        'closet_space' => $p->SellingPoint->closet_space,
			        'doorman1' => $p->SellingPoint->doorman1,
			        'elevator1' => $p->SellingPoint->elevator1,
			        'laundry_building1' => $p->SellingPoint->laundry_building1,
			        'laundry_unit1' => $p->SellingPoint->laundry_unit1,
			        'low_floor' => $p->SellingPoint->low_floor,
			        'luxury_building' => $p->SellingPoint->luxury_building,
			        'modern' => $p->SellingPoint->modern,
			        'natural_light' => $p->SellingPoint->natural_light,
			        'newly_renovated' => $p->SellingPoint->newly_renovated,
			        'private_outdoor1' => $p->SellingPoint->private_outdoor1,
			        'proximity_subway' => $p->SellingPoint->proximity_subway,
			        'quiet_peaceful' => $p->SellingPoint->quiet_peaceful,
			        'views' => $p->SellingPoint->views,
			        'size' => $p->SellingPoint->size
		        ],
		        'amenities' => [
		        	'cats' => $p->Amenities->cats,
					'dogs' => $p->Amenities->dogs,
					'dish_washer' => $p->Amenities->dish_washer,
					'doorman1' => $p->Amenities->doorman1,
					'elevator1' => $p->Amenities->elevator1,
					'furnished' => $p->Amenities->furnished,
					'gym' => $p->Amenities->gym,
					'pool' => $p->Amenities->pool,
					'laundry_unit1' => $p->Amenities->laundry_unit1,
					'laundry_building1' => $p->Amenities->laundry_unit1,
					'no_fee' => $p->Amenities->no_fee,
					'private_outdoor1' => $p->Amenities->private_outdoor1,
					'common_outdoor' => $p->Amenities->common_outdoor,
					'central_ac' => $p->Amenities->central_ac,
					'fire_place' => $p->Amenities->fire_place,
					'childrens_playroom' => $p->Amenities->childrens_playroom,
					'concierge' => $p->Amenities->concierge,
					'live_in_super' => $p->Amenities->live_in_super,
					'lounge' => $p->Amenities->lounge,
					'parking' => $p->Amenities->parking,
					'storage_room' => $p->Amenities->storage_room
		        ]
		    ]
		];

		$client->index($params);
	}
}
