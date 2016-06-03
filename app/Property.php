<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use App\User;
use App\Amenities;
use App\Neighborhood;
use App\Helpers\NeighborhoodFilter;
use Image;
use App\Photo;
use Auth;

class Property extends Model
{   
    protected $fillable = [
        'address', 
        'postal_code',
        'lng',
        'lat',
        'suite',
        'slug',
        'neighborhood',
        'ref',
        'sale_type',
        'sale_sub_type',
        'price',
        'user_id',
        'description',
        'beds',
        'baths',
        'ft2'
    ];

    public function Amenities()
    {
        return $this->hasOne('App\Amenities');
    }


    public function SellingPoint()
    {
        return $this->hasOne('App\SellingPoint');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function GetUserById()
    {
        return User::findOrFail($this->user_id);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function thumbnail()
    {
        if($this->photos->count() > 0)
        {   
            return $this->photos->first()->checkIfThumbnailisFromHere();
        }

        return "";
    }


    public function checkIfHasPhotos()
    {
        return (bool) $this->photos->count();
    }


    public function createPhotos(Request $request)
    {
        if($request->hasFile('file'))
        {   
            $photo = $request->file('file');
            $path = 'images/properties/pictures/';
            $name = time().$request->input('initial_property_id').$photo->getClientOriginalName();
            $photo->move($path, $name);
            $photo = Photo::create([
                'initial_property_id' => Auth::user()->name.$request->input('initial_property_id'),
                'path' => $path.$name,
                'thumbnail_path' => $path.'tn-'.$name,
                'property_id' => $request->input('property_id')
            ]);
            Image::make($photo->path)->fit(400, 370)->save($path.'tn-'.$name);
        }
    }


    public function savePicture(Request $request)
    {
        $photos = Photo::where('initial_property_id', Auth::user()->name.$request->input('slug'))->get();
        foreach($photos as $photo)
        {
            $photo->property_id = $this->id;
            $photo->save();
        }
    }

    //----------------------------------------Search Queries-------------------------------------------
    private function SearchQuery(Request $request)
    {

        $params = [
            'body' => [
                'size' => 1000,
                'query' => [
                    'bool' => [
                        'must' => [
                            ['range' => [
                                'price' => [
                                    'gte' => $request->input('min') - ($request->input('min') / 5),
                                    'lte' => $request->input('max') + ($request->input('max') / 5)
                                ]
                            ]],
                            ['range' => [
                                'beds' => [
                                    'gte' => $request->input('beds')
                                ]
                            ]]
                        ]
                    ]
                ]
            ]
        ];



       return $this->checkNeighborhoodVecinity($this->runQuery($params), $request->input('location'));
    }


    private function runQuery($params)
    {
        $client = ClientBuilder::create()->build();
        $p = $client->search($params);
        $p = $p['hits']['hits'];
        return $p;
    }

    private function checkNeighborhoodVecinity($p, $neighborhood)
    {   
        $properties = new NeighborhoodFilter($p, $neighborhood);
        return $properties->filterNeighborhood();
    }

    //--------------------------Get Properties and matching score from Search Request--------------------
    public function getPropertiesFromSearch(Request $request)
    {  
        return $this->getMatchingScore($this->SearchQuery($request), $request);
    }


    private function getMatchingScore($p, Request $request)
    {
        foreach($p as $property)
        {
            $property["match"] = 0;
            //----------------------------------------Price Calculation-----------------------------------
            if(($property['_source']['price'] >= $request->input('min') - ($request->input('min') / 10)) && 
                ($property['_source']['price'] <= $request->input('max') + ($request->input('max')/ 20))){
                $property['match'] += 10;
            }
            if(($property["_source"]["price"] >= $request->input('min') - ($request->input('min') / 100 * 15)) && 
                ($property["_source"]["price"] <= ($request->input('min') - ($request->input('min')/10))-1)){
                $property['match'] += 5;
            }
            if(($property["_source"]["price"] >= ($request->input('max') + ($request->input('max') /20))+1) && 
                ($property["_source"]["price"] <= ($request->input('max') + ($request->input('max') / 100 * 15)))){
                $property['match'] += 5;
            }
            //----------------------------------------Price Calculation-----------------------------------
            if($property['_source']['neighborhood'] == $request->input('location')){
                $property['match'] += 16;
            }
            if($property['_source']['neighborhood'] != $request->input('location')){
                $property['match'] += 8;
            }
            if($property['_source']['beds'] == $request->input('beds')){
                $property['match'] += 10;
            }
            if($property['_source']['selling_points'][$request->input('gq1')] == 1){
                $property['match'] += 35;
            }
            if($property['_source']['selling_points'][$request->input('gq2')] == 1){
                $property['match'] += 20;
            }
            if($property['_source']['selling_points'][$request->input('gq3')] == 1){
                $property['match'] += 9;
            }
            $properties[] = $property;
        }
        if(!isset($properties))
        {
            $properties = [];
            return $properties;
        }
        foreach ($properties as $key => $row) {
            $match[$key]  = $row['match'];
        }
        array_multisort($match, SORT_DESC, $properties);
        return $this->getCalculatedValue($properties, $request);
    }


    //------------------------------------Second calculated values for amenities----------------
    private function getCalculatedValue($p, Request $request){
        foreach($p as $property)
        {
            $property["calculated_value"] = 0;
            //----------------------------------------------Price Calculation-----------------------------------
            if(($property['_source']['price'] >= $request->input('min') - ($request->input('min') / 10)) && ($property['_source']['price'] <= $request->input('max') + ($request->input('max') / 20))){
                $property["calculated_value"] += 10;
            }
            if(($property["_source"]["price"] >= $request->input('min') - ($request->input('min') / 100 * 15)) && 
                ($property["_source"]["price"] <= ($request->input('min') - ($request->input('min')/10))-1)){
                $property['calculated_value'] += 5;
            }
            if(($property["_source"]["price"] >= ($request->input('max') + ($request->input('max') /20))+1) && 
                ($property["_source"]["price"] <= ($request->input('max') + ($request->input('max') / 100 * 15)))){
                $property['calculated_value'] += 5;
            }
            //----------------------------------------------Price Calculation-----------------------------------
            if($property['_source']['neighborhood'] == $request->input('location')){
                $property["calculated_value"] += 10;
            }
            if($property['_source']['neighborhood'] != $request->input('location')){
                $property["calculated_value"] += 5;
            }
            if($property['_source']['beds'] == $request->input('beds')){
                $property["calculated_value"] += 10;
            }
            if($property['_source']['selling_points'][$request->input('gq1')] == 1){
                $property["calculated_value"] += 30;
            }
            if($property['_source']['selling_points'][$request->input('gq2')] == 1){
                $property["calculated_value"] += 15;
            }
            if($property['_source']['selling_points'][$request->input('gq3')] == 1){
                $property["calculated_value"] += 5;
            }
            $properties[] = $property;
        }
        if(!isset($properties))
        {
            $properties = [];
        }
        return $this->getAmenities($properties);
    }



//------------------------------------------------Amenities----------------------------------------------
    private function getAmenities($p)
    {   
        foreach($p as $property)
        {   
            $property["amenitiesClasses"]  = array();
            if($property["_source"]["amenities"]["cats"] == 1){
                array_push($property["amenitiesClasses"], "cats");
            }
            if($property["_source"]["amenities"]["dogs"] == 1){
                array_push($property["amenitiesClasses"], "dogs");
            }
            if($property["_source"]["amenities"]["dish_washer"] == 1){
                array_push($property["amenitiesClasses"], "dish_washer");
            }
            if($property["_source"]["amenities"]["doorman1"] == 1){
                array_push($property["amenitiesClasses"], "doorman1");
            }
            if($property["_source"]["amenities"]["elevator1"] == 1){
                array_push($property["amenitiesClasses"], "elevator1");
            }
            if($property["_source"]["amenities"]["furnished"] == 1){
                array_push($property["amenitiesClasses"], "furnished");
            }
            if($property["_source"]["amenities"]["gym"] == 1){
                array_push($property["amenitiesClasses"], "gym");
            }
            if($property["_source"]["amenities"]["pool"] == 1){
                array_push($property["amenitiesClasses"], "pool");
            }
            if($property["_source"]["amenities"]["laundry_unit1"] == 1){
                array_push($property["amenitiesClasses"], "laundry_unit1");
            }
            if($property["_source"]["amenities"]["laundry_building1"] == 1){
                array_push($property["amenitiesClasses"], "laundry_building1");
            }
            if($property["_source"]["amenities"]["no_fee"] == 1){
                array_push($property["amenitiesClasses"], "no_fee");
            }
            if($property["_source"]["amenities"]["private_outdoor1"] == 1){
                array_push($property["amenitiesClasses"], "private_outdoor1");
            }
            if($property["_source"]["amenities"]["common_outdoor"] == 1){
                array_push($property["amenitiesClasses"], "common_outdoor");
            }
            if($property["_source"]["amenities"]["central_ac"] == 1){
                array_push($property["amenitiesClasses"], "central_ac");
            }
            if($property["_source"]["amenities"]["fire_place"] == 1){
                array_push($property["amenitiesClasses"], "fire_place");
            }
            if($property["_source"]["amenities"]["childrens_playroom"] == 1){
                array_push($property["amenitiesClasses"], "childrens_playroom");
            }
            if($property["_source"]["amenities"]["concierge"] == 1){
                array_push($property["amenitiesClasses"], "concierge");
            }
            if($property["_source"]["amenities"]["live_in_super"] == 1){
                array_push($property["amenitiesClasses"], "live_in_super");
            }
            if($property["_source"]["amenities"]["lounge"] == 1){
                array_push($property["amenitiesClasses"], "lounge");
            }
            if($property["_source"]["amenities"]["parking"] == 1){
                array_push($property["amenitiesClasses"], "parking");
            }
            if($property["_source"]["amenities"]["storage_room"] == 1){
                array_push($property["amenitiesClasses"], "storage_room");
            }
            $properties[] = $property;
        }
        if(!isset($properties))
        {
            $properties = [];
        }
        return $properties;
    }

    // -----------------------------------------Check if it has Selling Points-------------------------

    public function checkIfHasSellingPoints()
    {
        $count = 0;
        ($this->SellingPoint->character == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->chefs_kitchen == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->closet_space == 1 ? $count += 1 : $count += 0);
        // ($this->SellingPoint->doorman1 == 1 ? $count += 1 : $count += 0);
        // ($this->SellingPoint->elevator1 == 1 ? $count += 1 : $count += 0);
        // ($this->SellingPoint->laundry_building1 == 1 ? $count += 1 : $count += 0);
        // ($this->SellingPoint->laundry_unit1 == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->low_floor == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->luxury_building == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->modern == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->natural_light == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->newly_renovated == 1 ? $count += 1 : $count += 0);
        // ($this->SellingPoint->private_outdoor1 == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->proximity_subway == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->quiet_peaceful == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->views == 1 ? $count += 1 : $count += 0);
        ($this->SellingPoint->size == 1 ? $count += 1 : $count += 0);

        if($count < 3){
            return "SellingPointIncomplete";
        }

        return  "SellingPointComplete";

    }


    //------------------------------------------Update--------------------------------------------------

    public function updateProperty(Request $request)
    {
        $this->update($request->input());
        $this->updateSellingPoint($request);
        $this->updateAmenities($request);
    }



    public function updateSellingPoint(Request $request, $sellingPointAmenities = null)
    {
      $this->SellingPoint()->update([
            'character' => $request->input('character'),
            'chefs_kitchen' => $request->input('chefs_kitchen'),
            'closet_space' => $request->input('closet_space'),
            'doorman1' => ($request->input('doorman1') != null ? $request->input('doorman1') : $sellingPointAmenities['doorman1']), //
            'elevator1' => ($request->input('elevator1') != null ? $request->input('elevator1') : $sellingPointAmenities['elevator1']),//
            'laundry_building1' => ($request->input('laundry_building1') != null ? $request->input('laundry_building1') : $sellingPointAmenities['laundry_building1']),//
            'laundry_unit1' => $request->input('laundry_unit1'),//
            'low_floor' => $request->input('low_floor'),
            'luxury_building' => $request->input('luxury_building'),
            'modern' => $request->input('modern'),
            'natural_light' => $request->input('natural_light'),
            'newly_renovated' => $request->input('newly_renovated'),
            'private_outdoor1' => $request->input('private_outdoor1'),//
            'proximity_subway' => $request->input('proximity_subway'),
            'quiet_peaceful' => $request->input('quiet_peaceful'),
            'views' => $request->input('views'),
            'size' => $request->input('size')
        ]);  
    }

    public function updateAmenities(Request $request)
    {
        $this->Amenities()->update([
            'cats' => $request->input('cats'),
            'dogs' => $request->input('dogs'),
            'dish_washer' => $request->input('dish_washer'),
            'doorman1' => $request->input('doorman1'),
            'elevator1' => $request->input('elevator1'),
            'furnished' => $request->input('furnished'),
            'gym' => $request->input('gym'),
            'pool' => $request->input('pool'),
            'laundry_unit1' => $request->input('laundry_unit1'),
            'laundry_building1' => $request->input('laundry_building1'),
            'no_fee' => $request->input('no_fee'),
            'private_outdoor1' => $request->input('private_outdoor1'),
            'common_outdoor' => $request->input('common_outdoor'),
            'central_ac' => $request->input('central_ac'),
            'fire_place' => $request->input('fire_place'),
            'childrens_playroom' => $request->input('childrens_playroom'),
            'concierge' => $request->input('concierge'),
            'live_in_super' => $request->input('live_in_super'),
            'lounge' => $request->input('lounge'),
            'parking' => $request->input('parking'),
            'storage_room' => $request->input('storage_room')
        ]);
    }
}


        