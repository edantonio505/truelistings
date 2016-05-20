<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Neighborhood;
use App\Property;
use Elasticsearch\ClientBuilder;

class PagesController extends Controller
{
	public function index()
	{	
		$num = rand(1, 3);
		$neighborhoods = Neighborhood::first()->currentNeighborhoods();
		return view('welcome')->withNeighborhoods($neighborhoods)->withNum($num);
	}
}
