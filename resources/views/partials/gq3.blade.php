            @if($query->input('gq3') == 'character')
                  has character.
            @elseif($query->input('gq3') == 'chefs_kitchen')
                  has a chef's kitchen.
            @elseif($query->input('gq3') == 'closet_space')
                  has closet space.
            @elseif($query->input('gq3') == 'doorman1')
                  has a doorman.
            @elseif($query->input('gq3') == 'elevator1')
                  has an elevator.
            @elseif($query->input('gq3') == 'laundry_building1')
                  has laundry in building.
            @elseif($query->input('gq3') == 'laundry_unit1')
                  has laundry in unit.
            @elseif($query->input('gq3') == 'low_floor')
                  has low floor.
            @elseif($query->input('gq3') == 'luxury_building')
                  is a luxurious building.
            @elseif($query->input('gq3') == 'modern')
                  is a modern building.
            @elseif($query->input('gq3') == 'natural_light')
                  has natural light.
            @elseif($query->input('gq3') == 'newly_renovated')
                  has new renovations.
            @elseif($query->input('gq3') == 'private_outdoor1')
                  has private outdoor.
            @elseif($query->input('gq3') == 'proximity_subway')
                  has proximity to subway.
            @elseif($query->input('gq3') == 'quiet_peaceful')
                  is quiet & peaceful.
            @elseif($query->input('gq3') == 'views')
                  has great views.
            @elseif($query->input('gq3') == 'size')
                  is oversized.
            @endif