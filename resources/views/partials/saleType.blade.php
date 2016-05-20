@if((isset($property) && $property->sale_type == 'rent')||(old('sale_type') == 'rent'))
	<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="sale_sub_type" id="building-rental">
		<option value="">Select building type</option>
		<option value="rental"
		{{ ((isset($property) && $property->sale_sub_type == 'rental')||(old('sale_sub_type') == 'rental') ? 'selected="selected"' : '') }}
		>Rental</option>
		<option value="co-op"
		{{ ((isset($property) && $property->sale_sub_type == 'co-op')||(old('sale_sub_type') == 'co-op') ? 'selected="selected"' : '') }}
		>Co-op</option>
		<option value="condo"
		{{ ((isset($property) && $property->sale_sub_type == 'condo')||(old('sale_sub_type') == 'condo') ? 'selected="selected"' : '') }}
		>Condo</option>
		<option value="townhouse"
		{{ ((isset($property) && $property->sale_sub_type == 'townhouse')||(old('sale_sub_type') == 'townhouse') ? 'selected="selected"' : '') }}
		>Townhouse</option>
	</select>
	<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} id="building-sale" style="display:none;">
		<option value="">Select building type</option>
		<option value="for-sale"
		{{ ((isset($property) && $property->sale_sub_type == 'for-sale')||(old('sale_sub_type') == 'for-sale') ? 'selected="selected"' : '') }}
		>For Sale</option>
		<option value="co-op"
		{{ ((isset($property) && $property->sale_sub_type == 'co-op')||(old('sale_sub_type') == 'co-op') ? 'selected="selected"' : '') }}
		>Co-op</option>
		<option value="condos"
		{{ ((isset($property) && $property->sale_sub_type == 'condos')||(old('sale_sub_type') == 'condos') ? 'selected="selected"' : '') }}
		>Condos</option>
		<option value="residential"
		{{ ((isset($property) && $property->sale_sub_type == 'residential')||(old('sale_sub_type') == 'residential') ? 'selected="selected"' : '') }}
		>Residential</option>
		<option value="townhouse"
		{{ ((isset($property) && $property->sale_sub_type == 'townhouse')||(old('sale_sub_type') == 'townhouse') ? 'selected="selected"' : '') }}
		>Townhouse</option>
		<option value="exclusive"
		{{ ((isset($property) && $property->sale_sub_type == 'exclusive')||(old('sale_sub_type') == 'exclusive') ? 'selected="selected"' : '') }}
		>Exclusive Listing</option>
	</select>
@elseif((isset($property) && $property->sale_type == 'sale')||(old('sale_type') == 'sale'))
	<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} id="building-rental" style="display: none;">
		<option value="">Select building type</option>
		<option value="rental"
		{{ ((isset($property) && $property->sale_sub_type == 'rental')||(old('sale_sub_type') == 'rental') ? 'selected="selected"' : '') }}
		>Rental</option>
		<option value="co-op"
		{{ ((isset($property) && $property->sale_sub_type == 'co-op')||(old('sale_sub_type') == 'co-op') ? 'selected="selected"' : '') }}
		>Co-op</option>
		<option value="condo"
		{{ ((isset($property) && $property->sale_sub_type == 'condo')||(old('sale_sub_type') == 'condo') ? 'selected="selected"' : '') }}
		>Condo</option>
		<option value="townhouse"
		{{ ((isset($property) && $property->sale_sub_type == 'townhouse')||(old('sale_sub_type') == 'townhouse') ? 'selected="selected"' : '') }}
		>Townhouse</option>
	</select>
	<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="sale_sub_type" id="building-sale">
		<option value="">Select building type</option>
		<option value="for-sale"
		{{ ((isset($property) && $property->sale_sub_type == 'for-sale')||(old('sale_sub_type') == 'for-sale') ? 'selected="selected"' : '') }}
		>For Sale</option>
		<option value="co-op"
		{{ ((isset($property) && $property->sale_sub_type == 'co-op')||(old('sale_sub_type') == 'co-op') ? 'selected="selected"' : '') }}
		>Co-op</option>
		<option value="condos"
		{{ ((isset($property) && $property->sale_sub_type == 'condos')||(old('sale_sub_type') == 'condos') ? 'selected="selected"' : '') }}
		>Condos</option>
		<option value="residential"
		{{ ((isset($property) && $property->sale_sub_type == 'residential')||(old('sale_sub_type') == 'residential') ? 'selected="selected"' : '') }}
		>Residential</option>
		<option value="townhouse"
		{{ ((isset($property) && $property->sale_sub_type == 'townhouse')||(old('sale_sub_type') == 'townhouse') ? 'selected="selected"' : '') }}
		>Townhouse</option>
		<option value="exclusive"
		{{ ((isset($property) && $property->sale_sub_type == 'exclusive')||(old('sale_sub_type') == 'exclusive') ? 'selected="selected"' : '') }}
		>Exclusive Listing</option>
	</select>

@else
<select  {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="sale_sub_type" id="building-rental" style="display: none;">
		<option value="">Select building type</option>
		<option value="rental"
		{{ ((isset($property) && $property->sale_sub_type == 'rental')||(old('sale_sub_type') == 'rental') ? 'selected="selected"' : '') }}
		>Rental</option>
		<option value="co-op"
		{{ ((isset($property) && $property->sale_sub_type == 'co-op')||(old('sale_sub_type') == 'co-op') ? 'selected="selected"' : '') }}
		>Co-op</option>
		<option value="condo"
		{{ ((isset($property) && $property->sale_sub_type == 'condo')||(old('sale_sub_type') == 'condo') ? 'selected="selected"' : '') }}
		>Condo</option>
		<option value="townhouse"
		{{ ((isset($property) && $property->sale_sub_type == 'townhouse')||(old('sale_sub_type') == 'townhouse') ? 'selected="selected"' : '') }}
		>Townhouse</option>
	</select>

	<select {{ (isset($property) ? 'class=saveEditedSelect': '') }} name="sale_sub_type" id="building-sale" style="display:none;">
		<option value="">Select building type</option>
		<option value="for-sale"
		{{ ((isset($property) && $property->sale_sub_type == 'for-sale')||(old('sale_sub_type') == 'for-sale') ? 'selected="selected"' : '') }}
		>For Sale</option>
		<option value="co-op"
		{{ ((isset($property) && $property->sale_sub_type == 'co-op')||(old('sale_sub_type') == 'co-op') ? 'selected="selected"' : '') }}
		>Co-op</option>
		<option value="condos"
		{{ ((isset($property) && $property->sale_sub_type == 'condos')||(old('sale_sub_type') == 'condos') ? 'selected="selected"' : '') }}
		>Condos</option>
		<option value="residential"
		{{ ((isset($property) && $property->sale_sub_type == 'residential')||(old('sale_sub_type') == 'residential') ? 'selected="selected"' : '') }}
		>Residential</option>
		<option value="townhouse"
		{{ ((isset($property) && $property->sale_sub_type == 'townhouse')||(old('sale_sub_type') == 'townhouse') ? 'selected="selected"' : '') }}
		>Townhouse</option>
		<option value="exclusive"
		{{ ((isset($property) && $property->sale_sub_type == 'exclusive')||(old('sale_sub_type') == 'exclusive') ? 'selected="selected"' : '') }}
		>Exclusive Listing</option>
	</select>
@endif