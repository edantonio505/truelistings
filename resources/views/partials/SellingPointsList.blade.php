<div class="large-6 columns">
  <div style="display:block; widht:100%; background-color:#e6e6e6;">
  	<h5 style="padding:5px;">Selling Point (select 3)</h5>
  </div>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='character' value='1' 
      {{ ((isset($property) && $property->SellingPoint->character == 1)||(old('character') == 1) ? 'checked' : '') }}
    />Character<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='chefs_kitchen' value='1' 
      {{ ((isset($property) && $property->SellingPoint->chefs_kitchen == 1)||(old('chefs_kitchen') == 1) ? 'checked' : '') }}
    />Chef's Kitchen<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='closet_space' value='1' 
      {{ ((isset($property) && $property->SellingPoint->closet_space == 1)||(old('closet_space') == 1) ? 'checked' : '') }}
    />Closet Space<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='low_floor' value='1' 
      {{ ((isset($property) && $property->SellingPoint->low_floor == 1)||(old('low_floor') == 1) ? 'checked' : '') }}
    />Low Floor<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='luxury_building' value='1' 
      {{ ((isset($property) && $property->SellingPoint->luxury_building == 1)||(old('luxury_building') == 1) ? 'checked' : '') }}
    />Luxurious Building<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='modern' value='1' 
      {{ ((isset($property) && $property->SellingPoint->modern == 1)||(old('modern') == 1) ? 'checked' : '') }}
    />Modern Building<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='natural_light' value='1' 
      {{ ((isset($property) && $property->SellingPoint->natural_light == 1)||(old('natural_light') == 1) ? 'checked' : '') }}
    />Natural Light<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='newly_renovated' value='1' 
      {{ ((isset($property) && $property->SellingPoint->newly_renovated == 1)||(old('newly_renovated') == 1) ? 'checked' : '') }}
    />New Renovations<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='proximity_subway' value='1' 
      {{ ((isset($property) && $property->SellingPoint->proximity_subway == 1)||(old('proximity_subway') == 1) ? 'checked' : '') }}
    />Near Subway<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='quiet_peaceful' value='1' 
      {{ ((isset($property) && $property->SellingPoint->quiet_peaceful == 1)||(old('quiet_peaceful') == 1) ? 'checked' : '') }}
    />Quiet & Peaceful<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='views' value='1' 
      {{ ((isset($property) && $property->SellingPoint->views == 1)||(old('views') == 1) ? 'checked' : '') }}
    />Views<br/>
    <input {{ (isset($property) ? 'class=saveEditedCheckbox': '') }} type="checkbox" name='size' value='1' 
      {{ ((isset($property) && $property->SellingPoint->size == 1)||(old('size') == 1) ? 'checked' : '') }}
    />Oversized<br/>
</div>