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
		return view('master');
	}
}
