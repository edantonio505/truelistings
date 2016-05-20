<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;
use App\Property;


class IndexController extends Controller
{



    //------------------------Index Management------------------------------------------
	public function deleteIndex()
	{	
		$client = ClientBuilder::create()->build();
		$params = ['index' => 'truelistings'];
		$response = $client->indices()->delete($params);
		dd($response);
	}

	public function createIndex()
	{
		$client = ClientBuilder::create()->build();
		$params = [
		    'index' => 'truelistings',
		    'body' => [
		        'mappings' => [
		            'property' => [
		                '_source' => [
		                    'enabled' => true
		                ],
		                'properties' => [
	                        'price' => ['type' => 'long'],
	                        'user_id' => ['type' => 'long'],
	                        'beds' => ['type' => 'long'],
	                        'baths' => ['type' => 'long'],
	                        'location' => ['type' => 'geo_point']
		                ]
		            ]
		        ]
		    ]
		];


		// Create the index with mappings and settings now
		$response = $client->indices()->create($params);


		dd($response);
	}



	public function reIndex()
	{	
		set_time_limit(0);
		$client = ClientBuilder::create()->build();


		$properties =  Property::all();
		
		foreach($properties as $p){

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

		return 'done';

	}


	public function createMapping()
	{
		$client = ClientBuilder::create()->build();


		$params = [
		    'index' => 'truelistings',
		    'type' => 'property',
		    'body' => [
		        'property' => [
		            '_source' => [
		                'enabled' => true
		            ],
		            'properties' => [
		                'price' => ['type' => 'long'],
		                'user_id' => ['type' => 'long'],
		                'beds' => ['type' => 'long'],
		                'baths' => ['type' => 'long'],
		                'location' => ['type' => 'geo_point']
		            ]
		        ]
		    ]
		];


		$response = $client->indices()->putMapping($params);
		dd($response);
	}



	public function get_index_mapping()
	{	
		$client = ClientBuilder::create()->build();
		$response = $client->indices()->getMapping();

		dd($response);
		return view('test');
	}
	//------------------------------------------------------------------------------------

}
