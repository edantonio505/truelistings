<div class="large-6 columns" id="amenitiesCheckbox">
  <div style="display:block; widht:100%; background-color:#e6e6e6;">
  	<h5 style="padding:5px;">Amenities</h5>
  </div>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="cats" value="1"
    {{ ((isset($property) && $property->Amenities->cats == 1)||(old('cats') == 1) ? 'checked' : '')  }}
  >Cats ok<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="dogs" value="1"
    {{ ((isset($property) && $property->Amenities->dogs == 1)||(old('dogs') == 1) ? 'checked' : '') }}
  >Dogs ok<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="dish_washer" value="1"
    {{ ((isset($property) && $property->Amenities->dish_washer == 1)||(old('dish_washer') == 1) ? 'checked' : '') }}
  >Dishwasher<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="doorman1" value="1"
    {{ ((isset($property) && $property->Amenities->doorman1 == 1)||(old('doorman1') == 1) ? 'checked' : '') }}
  >Doorman<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="elevator1" value="1"
    {{ ((isset($property) && $property->Amenities->elevator1 == 1)||(old('elevator1') == 1) ? 'checked' : '') }}
  >Elevator<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="furnished" value="1"
    {{ ((isset($property) && $property->Amenities->furnished == 1)||(old('furnished') == 1) ? 'checked' : '') }}
  >Furnished<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="gym" value="1"
    {{ ((isset($property) && $property->Amenities->gym == 1)||(old('gym') == 1) ? 'checked' : '') }}
  >Gym<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="pool" value="1"
    {{ ((isset($property) && $property->Amenities->pool == 1)||(old('pool') == 1) ? 'checked' : '') }}
  >Pool<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="laundry_building1" value="1"
    {{ ((isset($property) && $property->Amenities->laundry_building1 == 1)||(old('laundry_building1') == 1) ? 'checked' : '') }}
  >Laundry in Building<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="laundry_unit1" value="1"
    {{ ((isset($property) && $property->Amenities->laundry_unit1 == 1)||(old('laundry_unit1') == 1) ? 'checked' : '') }}
  >Laundry in Unit<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="no_fee" value="1"
    {{ ((isset($property) && $property->Amenities->no_fee == 1)||(old('no_fee') == 1) ? 'checked' : '') }}
  >No Fee<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="private_outdoor1" value="1"
    {{ ((isset($property) && $property->Amenities->private_outdoor1 == 1)||(old('private_outdoor1') == 1) ? 'checked' : '') }}
  >Private Outdoor Space<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="common_outdoor" value="1"
  {{ ((isset($property) && $property->Amenities->common_outdoor == 1)||(old('common_outdoor') == 1) ? 'checked' : '') }}
  >Common Outdoor Space<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="central_ac" value="1"
  {{ ((isset($property) && $property->Amenities->central_ac == 1)||(old('central_ac') == 1) ? 'checked' : '') }}
  >Central A/C<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="fire_place" value="1"
  {{ ((isset($property) && $property->Amenities->fire_place == 1)||(old('fire_place') == 1) ? 'checked' : '') }}
  >Fire Place<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="childrens_playroom" value="1"
  {{ ((isset($property) && $property->Amenities->childrens_playroom == 1)||(old('childrens_playroom') == 1) ? 'checked' : '') }}
  >Children's Playroom<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="concierge" value="1"
  {{ ((isset($property) && $property->Amenities->concierge == 1)||(old('concierge') == 1) ? 'checked' : '') }}
  >Concierge<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="live_in_super" value="1"
  {{ ((isset($property) && $property->Amenities->live_in_super == 1)||(old('live_in_super') == 1) ? 'checked' : '') }}
  >Live in Super<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="lounge" value="1"
  {{ ((isset($property) && $property->Amenities->lounge == 1)||(old('lounge') == 1) ? 'checked' : '') }}
  >Lounge<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="parking" value="1"
  {{ ((isset($property) && $property->Amenities->parking == 1)||(old('parking') == 1) ? 'checked' : '') }}
  >Parking<br>
  <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name="storage_room" value="1"
  {{ ((isset($property) && $property->Amenities->storage_room == 1)||(old('storage_room') == 1) ? 'checked' : '') }}
  >Storage Room<br>
</div>