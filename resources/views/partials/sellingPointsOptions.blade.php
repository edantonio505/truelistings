<div style="width:210px; min-height:220px; background-color: #9fe79f; text-shadow: 0px 1px 1px #bdbdbd; color:white; position: fixed; border-radius: 4px;">
	<div id="formInstructions" style="padding:20px; max-width:220px; position:fixed; text-align: justify;">
		<h5 style="text-align: center; font-size: 18px;">Edit Selling Points</h5>
		<p>Click on any property from the list if you want to add selling points to the property.</p>
	</div>
	
	@foreach($properties as $property)
	<div id="formVisible{{ $property->id }}" style="display: none; position:relative;">
		<form style="padding: 10px; padding-left: 20px;">
			<input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
		   	<input class="onTheFly"  type="checkbox" name='character' value='1'
		   	{{ ($property->SellingPoint->character == 1 ? 'checked' : '' ) }}
		   	 /> Character<br/>
			<input class="onTheFly"  type="checkbox" name='chefs_kitchen' value='1'
			{{ ($property->SellingPoint->chefs_kitchen == 1 ? 'checked' : '' ) }}
			 /> Chef's Kitchen<br/>
			<input class="onTheFly"  type="checkbox" name='closet_space' value='1'
			{{ ($property->SellingPoint->closet_space == 1 ? 'checked' : '' ) }}
			 /> Closet Space<br/>
			<input class="onTheFly"  type="checkbox" name='low_floor' value='1'
			{{ ($property->SellingPoint->low_floor == 1 ? 'checked' : '' ) }}
			 /> Low Floor<br/>
			<input class="onTheFly"  type="checkbox" name='luxury_building' value='1'
			{{ ($property->SellingPoint->luxury_building == 1 ? 'checked' : '' ) }}
			 /> Luxurious Building<br/>
			<input class="onTheFly"  type="checkbox" name='modern' value='1'
			{{ ($property->SellingPoint->modern == 1 ? 'checked' : '' ) }}
			/> Modern Building<br/>
			<input class="onTheFly"  type="checkbox" name='natural_light' value='1'
			{{ ($property->SellingPoint->natural_light == 1 ? 'checked' : '' ) }}
			 /> Natural Light<br/>
			<input class="onTheFly"  type="checkbox" name='newly_renovated' value='1'
			{{ ($property->SellingPoint->newly_renovated == 1 ? 'checked' : '' ) }}
			 /> New Renovations<br/>
			<input class="onTheFly"  type="checkbox" name='proximity_subway' value='1'
			{{ ($property->SellingPoint->proximity_subway == 1 ? 'checked' : '' ) }}
			 /> Proximity to Subway<br/>
			<input class="onTheFly"  type="checkbox" name='quiet_peaceful' value='1'
			{{ ($property->SellingPoint->quiet_peaceful == 1 ? 'checked' : '' ) }}
			 /> Quiet & Peaceful<br/>
			<input class="onTheFly"  type="checkbox" name='views' value='1'
			{{ ($property->SellingPoint->views == 1 ? 'checked' : '' ) }}
			 /> Views<br/>
			<input class="onTheFly"  type="checkbox" name='size' value='1'
			{{ ($property->SellingPoint->size == 1 ? 'checked' : '' ) }}
			 /> Oversized<br/>
		</form>
	</div>
	@endforeach
</div>