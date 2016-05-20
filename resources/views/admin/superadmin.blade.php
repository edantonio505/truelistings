@extends('layouts.app')


@section('content')
	<div class="container">
		<h3 class="grey-text">Welcome Edgar</h3>

		<ul class="tabs" data-tabs id="example-tabs">
	    	<li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Users</a></li>
	    	<li class="tabs-title"><a href="#panel2">Properties</a></li>
	    	<li class="tabs-title"><a href="#panel3">Neighborhoods</a></li>
	    </ul>

	    <div class="tabs-content" data-tabs-content="example-tabs">
	        <div class="tabs-panel is-active" id="panel1">
	       
			       <table>
				        <thead>
				          <tr>
				            <th width="450">User</th>
				            <th width="150">Admin Privileges</th>
				            <th width="150">Broker Privileges</th>
				            <th width="150">Change Privileges</th>
				          </tr>
				        </thead>
				        <tbody>


				        @foreach($users as $user)
				          <tr>
				          	<form method="post" action="{{ route('changePrivileges') }}">
				            <td>{{ $user->name }}</td>
				            <td><input name="{{ $user->id }}-isadmin" value="1" type="checkbox" 
				            	@if($user->isadmin == 1)
				            		checked
				            	@endif
				            ></td>
				            <td><input name="{{ $user->id }}-isbroker" value="1" type="checkbox" 
				            	@if($user->isbroker == 1)
				            		checked
				            	@endif
				            ></td>
				            <td><input type="submit" value="ok" style="margin-top:5px;" class="button"></td>
				            <input type="hidden" name="user" value="{{ $user->id }}">
				            {{ csrf_field() }}
				            </form>
				          </tr>
				        @endforeach
				        </tbody>
				    </table>
	        </div>
	        <div class="tabs-panel" id="panel2">
	        <h5>Total Properties({{ count($properties) }})</h5>
	         <table>
				        <thead>
				          <tr>
				            <th width="600">Properties</th>
				            <th width="300">User</th>
				          </tr>
				        </thead>
				        <tbody>


				        @foreach($properties as $property)
				          <tr>
				            <td>{{ $property->address }} - ${{ $property->price }} - {{ $property->beds }} beds - {{ $property->neighborhood }}</td>
				            <td>{{ $property->GetUserById()->name }}</td>
				          </tr>
				        @endforeach
				        </tbody>
				    </table>
	    	</div>
	    	<div class="tabs-panel" id="panel3">
	    		<table>
				        <thead>
				          <tr>
				            <th width="300">Neighborhood</th>
				            <th width="250">Value</th>
				            <th width="250">Lat</th>
				            <th width="150">Long</th>
				            <th>change</th>
				          </tr>
				        </thead>
				        <tbody>
				        @foreach($neighborhoods as $neighborhood)
				          <tr>
				            <td>{{ $neighborhood->name }}</td>
				            <td>{{ $neighborhood->value }}</td>
				            <td>{{ $neighborhood->lat }}</td>
				            <td>{{ $neighborhood->lng }}</td>
				            <td><a href="{{ route('editNeighborhood', ['id' => $neighborhood->id]) }}" class="button"><i class="fi-pencil"></i></a></td>
				          </tr>
				        @endforeach
				        </tbody>
				    </table>
	    	</div>
	    </div>


	</div>
@stop