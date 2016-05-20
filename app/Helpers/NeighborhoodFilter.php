<?php

namespace App\Helpers;



class NeighborhoodFilter
{	
	private $p;
	private $neighborhood;


	public function __construct($p, $neighborhood){
		$this->p = $p;
		$this->neighborhood = $neighborhood; 
	}


	public function filterNeighborhood()
	{	
		$neighborhood = $this->neighborhood;

		$properties = [];
        foreach($this->p as $property){
            if($neighborhood == 'Battery Park City'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Financial District' || 
                    $property["_source"]["neighborhood"] == 'TriBeCa'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Chelsea'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'West Village' || 
                    $property["_source"]["neighborhood"] == 'Flatiron District' || 
                    $property["_source"]["neighborhood"] == 'Union Square'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Chinatown'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'SoHo' || 
                    $property["_source"]["neighborhood"] == 'NoHo' || 
                    $property["_source"]["neighborhood"] == 'TriBeCa' ||
                    $property["_source"]["neighborhood"] == 'Lower East Side'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'East Harlem'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'West Harlem' || 
                    $property["_source"]["neighborhood"] == 'Upper East Side'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'East Village'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Gramercy Park' || 
                    $property["_source"]["neighborhood"] == 'Lower East Side' || 
                    $property["_source"]["neighborhood"] == 'Greenwich Village'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Financial District'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Battery Park City'|| 
                    $property["_source"]["neighborhood"] == 'TriBeCa'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Flatiron District'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Union Square' || 
                    $property["_source"]["neighborhood"] == 'Chelsea' ||
                    $property["_source"]["neighborhood"] == 'Gramercy Park' ||
                    $property["_source"]["neighborhood"] == 'Greenwich Village'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Gramercy Park'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Flatiron District' || 
                    $property["_source"]["neighborhood"] == 'Union Square' ||
                    $property["_source"]["neighborhood"] == 'Murray Hill' ||
                    $property["_source"]["neighborhood"] == 'Kips Bay'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Greenwich Village'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'West Village' || 
                    $property["_source"]["neighborhood"] == 'SoHo' || 
                    $property["_source"]["neighborhood"] == 'Union Square'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Kips Bay'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Murray Hill' || 
                    $property["_source"]["neighborhood"] == 'Gramercy Park'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Little Italy'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Chinatown' ||
                    $property["_source"]["neighborhood"] == 'SoHo' ||
                    $property["_source"]["neighborhood"] == 'TriBeCa' ||
                    $property["_source"]["neighborhood"] == 'Lower East Side' ||
                    $property["_source"]["neighborhood"] == 'NoLita'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Lower East Side'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Chinatown' ||
                    $property["_source"]["neighborhood"] == 'East Village' ||
                    $property["_source"]["neighborhood"] == 'SoHo' ||
                    $property["_source"]["neighborhood"] == 'Greenwich Village'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Midtown East'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Upper East Side' ||
                    $property["_source"]["neighborhood"] == 'Murray Hill'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Midtown West'){
                if(
                    $property["_source"]["neighborhood"] == $neighborhood || 
                    $property["_source"]["neighborhood"] == 'Upper West Side' ||
                    $property["_source"]["neighborhood"] == 'Chelsea'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Morningside Heights'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'West Harlem'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Murray Hill'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Kips Bay' ||
                    $property["_source"]["neighborhood"] == 'Midtown East'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'NoHo'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'SoHo' ||
                    $property["_source"]["neighborhood"] == 'Greenwich Village' ||
                    $property["_source"]["neighborhood"] == 'NoLita'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'NoLita'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Little Italy' ||
                    $property["_source"]["neighborhood"] == 'SoHo' ||
                    $property["_source"]["neighborhood"] == 'NoHo' ||
                    $property["_source"]["neighborhood"] == 'Chinatown' ||
                    $property["_source"]["neighborhood"] == 'Lower East Side'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'SoHo'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Little Italy' ||
                    $property["_source"]["neighborhood"] == 'NoLita' ||
                    $property["_source"]["neighborhood"] == 'NoHo' ||
                    $property["_source"]["neighborhood"] == 'NoLita' ||
                    $property["_source"]["neighborhood"] == 'West Village' ||
                    $property["_source"]["neighborhood"] == 'Greenwich Village' ||
                    $property["_source"]["neighborhood"] == 'TriBeCa'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'TriBeCa'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'West Village' ||
                    $property["_source"]["neighborhood"] == 'SoHo'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Union Square'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Flatiron District' ||
                    $property["_source"]["neighborhood"] == 'Chelsea' ||
                    $property["_source"]["neighborhood"] == 'Greenwich Village' ||
                    $property["_source"]["neighborhood"] == 'East Village'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Upper East Side'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Upper West Side' ||
                    $property["_source"]["neighborhood"] == 'Midtown East'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Upper West Side'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Upper East Side' ||
                    $property["_source"]["neighborhood"] == 'Midtown West'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Washington Heights'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'West Harlem'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'West Harlem'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Washington Heights' ||
                    $property["_source"]["neighborhood"] == 'Morningside Heights'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'West Village'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Greenwich Village' ||
                    $property["_source"]["neighborhood"] == 'Chelsea' ||
                    $property["_source"]["neighborhood"] == 'SoHo' ||
                    $property["_source"]["neighborhood"] == 'Union Square'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Queens - Astoria'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Queens - Long Island City'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Queens - Long Island City'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Queens - Astoria'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Brooklyn - Brooklyn Heights'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Brooklyn - Dumbo' || 
                    $property["_source"]["neighborhood"] == 'Brooklyn - Williamsburg'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Brooklyn - Dumbo'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Brooklyn - Brooklyn Heights' || 
                    $property["_source"]["neighborhood"] == 'Brooklyn - Williamsburg'){
                    $properties[] = $property;
                }
            }
            if($neighborhood == 'Brooklyn - Williamsburg'){
                if( 
                    $property["_source"]["neighborhood"] == $neighborhood ||
                    $property["_source"]["neighborhood"] == 'Brooklyn - Brooklyn Heights' || 
                    $property["_source"]["neighborhood"] == 'Brooklyn - Dumbo'){
                    $properties[] = $property;
                }
            }
        }
        return $properties;
	}
}