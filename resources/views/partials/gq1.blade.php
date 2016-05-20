            @if($query->input('gq1') == 'character')
                  has character
            @elseif($query->input('gq1') == 'chefs_kitchen')
                  has a chef's kitchen
            @elseif($query->input('gq1') == 'closet_space')
                  has closet space
            @elseif($query->input('gq1') == 'doorman1')
                  has a doorman
            @elseif($query->input('gq1') == 'elevator1')
                  has an elevator
            @elseif($query->input('gq1') == 'laundry_building1')
                  has laundry in building
            @elseif($query->input('gq1') == 'laundry_unit1')
                  has laundry in unit
            @elseif($query->input('gq1') == 'low_floor')
                  has low floor
            @elseif($query->input('gq1') == 'luxury_building')
                  is a luxurious building
            @elseif($query->input('gq1') == 'modern')
                  is a modern building
            @elseif($query->input('gq1') == 'natural_light')
                  has natural light
            @elseif($query->input('gq1') == 'newly_renovated')
                  has new renovations
            @elseif($query->input('gq1') == 'private_outdoor1')
                  has private outdoor
            @elseif($query->input('gq1') == 'proximity_subway')
                  has proximity to subway
            @elseif($query->input('gq1') == 'quiet_peaceful')
                  is quiet & peaceful
            @elseif($query->input('gq1') == 'views')
                  has great views
            @elseif($query->input('gq1') == 'size')
                  is oversized
            @endif
