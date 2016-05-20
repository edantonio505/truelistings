            @if($query->input('gq1') == 'character')
			Character
            @elseif($query->input('gq1') == 'chefs_kitchen')
            	Chef's kitchen
            @elseif($query->input('gq1') == 'closet_space')
            	Closet space
            @elseif($query->input('gq1') == 'doorman1')
            	Doorman
            @elseif($query->input('gq1') == 'elevator1')
            	Elevator
            @elseif($query->input('gq1') == 'laundry_building1')
            	Laundry in building
            @elseif($query->input('gq1') == 'laundry_unit1')
            	Laundry in unit
            @elseif($query->input('gq1') == 'low_floor')
            	Low floor
            @elseif($query->input('gq1') == 'luxury_building')
            	Luxurious building
            @elseif($query->input('gq1') == 'modern')
            	Modern building
            @elseif($query->input('gq1') == 'natural_light')
            	Natural light
            @elseif($query->input('gq1') == 'newly_renovated')
            	New renovations
            @elseif($query->input('gq1') == 'private_outdoor1')
            	Private outdoor
            @elseif($query->input('gq1') == 'proximity_subway')
            	Near Subway
            @elseif($query->input('gq1') == 'quiet_peaceful')
            	Quiet & peaceful
            @elseif($query->input('gq1') == 'views')
            	Great views
            @elseif($query->input('gq1') == 'size')
            	Oversized
            @endif