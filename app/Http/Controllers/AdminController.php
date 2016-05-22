<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Property;
use Auth;
use App\User;
use App\Neighborhood;

class AdminController extends Controller
{	
	public function dashboard()
	{
		if(Auth::user()->checkIsAdmin())
		{
			return view('admin.dashboard');
		}
		if(Auth::user()->checkIsAdmin() == False && Auth::user()->checkIsBroker() == True)
		{	
			$properties = Property::where('user_id', Auth::user()->id)->get();
			return view('admin.brokerdashboard')->withProperties($properties);
		}
		return redirect()->route('home');
	}




	public function brokerdashboard()
	{
		if(Auth::user()->checkIsAdmin())
		{	
			$properties = Property::where('user_id', Auth::user()->id)->get();
			return view('admin.brokerdashboard')->withProperties($properties);
		}
		return redirect()->route('home');
	}




	public function superdashboard()
	{
		if(Auth::user()->email == 'edantonio505@gmail.com')
		{	
			$neighborhoods = Neighborhood::all();
			$users = User::all();
			$properties = Property::all();
			return view('admin.superadmin')
				->withProperties($properties)
				->withUsers($users)
				->withNeighborhoods($neighborhoods);
		}
		return redirect()->route('home');
	}






	public function changePrivileges(Request $request)
	{	
		$user = User::findOrFail($request->input('user'));


		if($request->input($user->id.'-isadmin'))
		{
			$user->isadmin = 1;
			$user->save();
		} else {
			$user->isadmin = 0;
			$user->save();
		}

		if($request->input($user->id.'-isbroker'))
		{
			$user->isbroker = 1;
			$user->save();
		}else {
			$user->isbroker = 0;
			$user->save();
		}

		return redirect()->back();
	}


	public function editNeighborhood($id)
	{
		$neighborhood = Neighborhood::findOrFail($id);
		return view('property.edit_neighborhood')->withNeighborhood($neighborhood);
	}

	public function postNeighborhood(Request $request)
	{
		$neighborhood = Neighborhood::findOrFail($request->input('id'));
		$neighborhood->lat = $request->input('lat');
		$neighborhood->lng = $request->input('lng');
		$neighborhood->save();
		session()->flash('flash_message', 'You have edited Latitude and Longitude in the neighborhood');
		return redirect()->route('superadmindashboard');
	}



}
