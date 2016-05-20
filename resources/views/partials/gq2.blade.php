            @if($query->input('gq2') == 'character')
                  has character
            @elseif($query->input('gq2') == 'chefs_kitchen')
                  has a chef's kitchen
            @elseif($query->input('gq2') == 'closet_space')
                  has closet space
            @elseif($query->input('gq2') == 'doorman1')
                  has a doorman
            @elseif($query->input('gq2') == 'elevator1')
                  has an elevator
            @elseif($query->input('gq2') == 'laundry_building1')
                  has laundry in building
            @elseif($query->input('gq2') == 'laundry_unit1')
                  has laundry in unit
            @elseif($query->input('gq2') == 'low_floor')
                  has low floor
            @elseif($query->input('gq2') == 'luxury_building')
                  is a luxurious building
            @elseif($query->input('gq2') == 'modern')
                  is a modern building
            @elseif($query->input('gq2') == 'natural_light')
                  has natural light
            @elseif($query->input('gq2') == 'newly_renovated')
                  has new renovations
            @elseif($query->input('gq2') == 'private_outdoor1')
                  has private outdoor
            @elseif($query->input('gq2') == 'proximity_subway')
                  has proximity to subway
            @elseif($query->input('gq2') == 'quiet_peaceful')
                  is quiet & peaceful
            @elseif($query->input('gq2') == 'views')
                  has great views
            @elseif($query->input('gq2') == 'size')
                  is oversized
            @endif