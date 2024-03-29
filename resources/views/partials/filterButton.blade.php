<div class="filter-box">
	<h5 class="grey-text">Amenities Filter</h5>
	<div class="filter-container">
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="cats">Cats</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="dogs">Dogs</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="dish_washer">Dishwasher</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="doorman1"
			{{ ($query->input('gq1') == 'doorman1' || $query->input('gq2') == 'doorman1' || $query->input('gq3') == 'doorman1' ? 'disabled' : '') }}
		>Doorman</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="elevator1"
			{{ ($query->input('gq1') == 'elevator1' || $query->input('gq2') == 'elevator1' || $query->input('gq3') == 'elevator1' ? 'disabled' : '') }}
		>Elevator</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="furnished">Furnished</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="gym">Gym</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="pool">Pool</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="laundry_unit1"
			{{ ($query->input('gq1') == 'laundry_unit1' || $query->input('gq2') == 'laundry_unit1' || $query->input('gq3') == 'laundry_unit1' ? 'disabled' : '') }}
		>Laundry in Unit</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="laundry_building1"
	{{ ($query->input('gq1') == 'laundry_building1' || $query->input('gq2') == 'laundry_building1' || $query->input('gq3') == 'laundry_building1' ? 'disabled' : '') }}
		>Laundry in Building</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="no_fee">No Fee</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="private_outdoor1"
		{{ ($query->input('gq1') == 'private_outdoor1' || $query->input('gq2') == 'private_outdoor1' || $query->input('gq3') == 'private_outdoor1' ? 'disabled' : '') }}
		>Private Outdoor</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="common_outdoor">Common Outdoor Space</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="central_ac">Central A/C</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="fire_place">Fire Place</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="childrens_playroom">Children's Playroom</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="concierge">Concierge</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="live_in_super">Live in Super</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="lounge">Lounge</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="parking">Parking</button>
		<button class="sort expanded button filter" data-sort="order:desc" data-filter="storage_room">Storage Room</button>
	</div>
</div>