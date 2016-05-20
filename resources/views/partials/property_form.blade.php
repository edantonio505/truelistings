
	<input id="token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	@if(isset($property))
	<input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}" />
	@endif
	<ul class="tabs" data-tabs id="example-tabs">
	  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">General Details</a></li>
	  <li class="tabs-title"><a href="#panel2">Amenities/Selling Point</a></li>
	  <li 
	  @if(!isset($property))
	  	id="picturePanel"
	  @endif
	  class="tabs-title"><a href="#panel3">Images</a></li>
	</ul>

	<div class="tabs-content">
		<div class="tabs-panel is-active" id="panel1">
			<ul class="accordion" data-accordion>
			 

			  <li class="accordion-item is-active" data-accordion-item>
			    <a class="accordion-title">Location</a>
			    <div class="accordion-content" data-tab-content>
			    	<div class="row">
			    		<div class="small-12 large-12 columns">
							<h5>Find a new location <span class="savedAlert alertMessage">Saved</span></h5>
						</div>
			    		<div class="small-12 large-10 columns">
							<input id="geocomplete" type="text" placeholder="Type in an address"  />
						</div>
						<div class="small-12 large-2 columns">
							<input id="find" type="button" class="expanded button {{ (isset($property)? "saveInputFillButton": '') }}" value="Fill" />
						</div>
			    		<div class="small-12 large-4 columns">
							<label for="address">Address</label>
							<input name="address" id="address" type="text"
								value="{{ (isset($property) ? $property->address : old('address')) }}"
							/>
						</div>
						<div class="small-12 large-4 columns">
							<label for="zip">Zip Code</label>
							<input id="postal_code" name="postal_code" type="text"
								value="{{ (isset($property) ? $property->postal_code : old('postal_code')) }}"
							/>
						</div>
						<div class="small-12 large-4 columns">
							<label for="suite">Apartment <span class="suiteAlert alertMessage">Saved</span></label>
							<input id="suite" {{ (isset($property) ? 'class=saveEditedText': '') }}  type="text" name="suite"
								value="{{ (isset($property) ? $property->suite : old('suite')) }}"
							/>
						</div>
							<input name="lng" id="lng" type="hidden" 
								value="{{ (isset($property) ? $property->lng : old('lng')) }}"
							/>
							<input name="lat" id="lat" type="hidden" 
								value="{{ (isset($property) ? $property->lat : old('lat')) }}"
							/>
							<input type="hidden" id="slug" name="slug" 
								value="{{ (isset($property) ? $property->slug: old('slug')) }}"
							/>
						<div class="small-12 large-12 columns">
							<label for="neighborhood">Neighborhood
							<span class="neighborhoodAlert alertMessage">Saved</span></label>
							<select id="neighborhood"{{ (isset($property) ? 'class=saveEditedSelect': '') }} name="neighborhood">
								@include('partials.neighborhood')
							</select>
						</div>
					</div>
			    </div>
			  </li>


			  <li class="accordion-item" data-accordion-item>
			    <a class="accordion-title">Description</a>
			    <div class="accordion-content" data-tab-content>
			      <label for="ref">Ref#</label>
					<input type="text" name="ref" disabled value="5645559"/>
					<label for="sale_type">Sale Type 
					<span class="sale_typeAlert alertMessage">Saved</span></label>
					<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="sale_type" id="sale-type">
						<option value="{{ old('sale_type') }}">Sale Type</option>
						<option value="rent"
							{{ ((isset($property) && $property->sale_type == "rent")||(old('sale_type') == 'rent') ? 'selected="selected"' : '') }}
						>For Rent</option>
						<option value="sale"
							{{ ((isset($property) && $property->sale_type == "sale")||(old('sale_type') == 'sale') ? 'selected="selected"' : '') }}
						>For Sale</option>
					</select>
					<span class="sale_sub_typeAlert alertMessage">Saved</span>
					@include('partials.saleType')
					<label for="price">Price <span class="priceAlert alertMessage">Saved</span></label>
					<input id="price" {{ (isset($property) ? 'class=saveEditedText': '') }}  type="text" name="price" 
						value="{{ (isset($property) ? $property->price : old('price')) }}"
					/>
					<input type="hidden" name="user_id" 
						value="{{ (isset($property) ? $property->user->id : Auth::user()->id) }}"
					/>
					<label>Description <span class="descriptionAlert alertMessage">Saved</span></label>
					<textarea {{ (isset($property) ? 'class=saveEditedText': '') }} id="description-form" name="description">{{ (isset($property) ? $property->description : old('description')) }}</textarea>
			    </div>
			  </li>

			  <li class="accordion-item" data-accordion-item>
			    <a class="accordion-title">Details</a>
			    <div class="accordion-content" data-tab-content>
			    	<label for="beds">Beds <span class="bedsAlert alertMessage">Saved</span></label>
					<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="beds">
						<option value="">Beds</option>
						<option value="0"
							{{ ((isset($property) && $property->beds == 0)||(old('beds') == 0) ? 'selected="selected"' : '') }}
						>Studio</option>
						<option value="1"
							{{ ((isset($property) && $property->beds == 1)||(old('beds') == 1) ? 'selected="selected"' : '') }}
						>1</option>
						<option value="2"
							{{ ((isset($property) && $property->beds == 2)||(old('beds') == 2) ? 'selected="selected"' : '') }}
						>2</option>
						<option value="3"
							{{ ((isset($property) && $property->beds == 3)||(old('beds') == 3) ? 'selected="selected"' : '') }}
						>3</option>
						<option value="4"
							{{ ((isset($property) && $property->beds == 4)||(old('beds') == 4) ? 'selected="selected"' : '') }}
						>4</option>
						<option value="5"
							{{ ((isset($property) && $property->beds == 5)||(old('beds') == 5) ? 'selected="selected"' : '') }}
						>5</option>
						<option value="6"
							{{ ((isset($property) && $property->beds == 6)||(old('beds') == 6) ? 'selected="selected"' : '') }}
						>6</option>
						<option value="7"
							{{ ((isset($property) && $property->beds == 7)||(old('beds') == 7) ? 'selected="selected"' : '') }}
						>7</option>
						<option value="8"
							{{ ((isset($property) && $property->beds == 8)||(old('beds') == 8) ? 'selected="selected"' : '') }}
						>8</option>
					</select>
					<label for="baths">Baths 
					<span class="bathsAlert alertMessage">Saved</span></label>
					<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="baths">
						<option value="">Baths</option>
						<option value="1"
							{{ ((isset($property) && $property->baths == 1)||(old('baths') == 1) ? 'selected="selected"' : '') }}
						>1</option>
						<option value="15"
							{{ ((isset($property) && $property->baths == 15)||(old('baths') == 15) ? 'selected="selected"' : '') }}
						>1.5</option>
						<option value="2"
							{{ ((isset($property) && $property->baths == 2)||(old('baths') == 2) ? 'selected="selected"' : '') }}
						>2</option>
						<option value="25"
							{{ ((isset($property) && $property->baths == 25)||(old('baths') == 25) ? 'selected="selected"' : '') }}
						>2.5</option>
						<option value="3"
							{{ ((isset($property) && $property->baths == 3)||(old('baths') == 3) ? 'selected="selected"' : '') }}
						>3</option>
						<option value="35"
							{{ ((isset($property) && $property->baths == 35)||(old('baths') == 35) ? 'selected="selected"' : '') }}
						>3.5</option>
						<option value="4"
							{{ ((isset($property) && $property->baths == 4)||(old('baths') == 4) ? 'selected="selected"' : '') }}
						>4</option>
						<option value="45"
							{{ ((isset($property) && $property->baths == 45)||(old('baths') == 45) ? 'selected="selected"' : '') }}
						>4.5</option>
						<option value="5"
							{{ ((isset($property) && $property->baths == 5)||(old('baths') == 5) ? 'selected="selected"' : '') }}
						>5</option>
						<option value="55"
							{{ ((isset($property) && $property->baths == 55)||(old('baths') == 55) ? 'selected="selected"' : '') }}
						>5.5</option>
					</select>
					<label for="ft2">FT2 <span class="ft2Alert alertMessage">Saved</span></label></label>
					<input {{ (isset($property) ? 'class=saveEditedText': '') }} type="text" name="ft2" 
						value="{{ (isset($property) ? $property->ft2 : old('ft2')) }}"
					/>
			    </div>
			  </li>
			</ul>
		</div>

		<div class="tabs-panel" id="panel2">
			<div style="width:300px; height:30px; margin: 0 auto; text-align: center;">
				<h4 class="checkboxAlert alertMessage">Saved</h4>
			</div>
			@include('partials.amenities')
		</div>
		</form>
		<div class="tabs-panel" id="panel3">
			<h5>Images</h5>

			@if(!isset($property))
			<span id="picture-text" style="color:#e74242;">Please fill all the information before you can add pictures</span>
			@endif

			<form class="dropzone" id="picture-form" action="/upload_photo" 
				@if(!isset($property))
					style="display: none;"
				@endif
			>
				{{ csrf_field() }}
				<input type="hidden" id="initial_property_id" name="initial_property_id" 
					value="{{ (isset($property) ? $property->slug: old('slug')) }}"
				/>
				<input type="hidden" name="property_id" 

				value="{{ (isset($property) ? $property->id: '') }}"

				/>
			</form>
			@if(isset($property) && $property->checkIfHasPhotos() == True)
				<div style="padding-top: 30px;">
					<span style="margin-left: 15px;">Property's pictures</span>
					<form>
						<div class="row">
							@foreach($property->photos as $photo)
								<div class="medium-3 columns picture_container-{{ $photo->id }}" style="margin-top:10px;">
								<a style="position: relative; top:56px;" data-id="{{ $photo->id }}" class="button alert delete-picture">Delete</a><img src="{{ $photo->checkIfThumbnailisFromHere() }}"></div>
								<input id="picture_token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							@endforeach
						</div>
					</form>
				</div>
			@endif
		</div>
	</div>