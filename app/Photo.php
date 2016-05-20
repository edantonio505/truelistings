<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Photo extends Model
{
    protected $fillable = ['initial_property_id', 'path', 'thumbnail_path', 'property_id'];



    public function property()
    {
    	$this->belongsTo('App\Property');
    }

    public function checkIfPathIsfromHere()
    {
    	$picturePath = $this->path;
    	if(substr( $picturePath, 0, 7 ) === 'images/')
    	{
    		return '/'.$this->path;
    	}

    	return $this->path;

    }

    public function checkIfThumbnailisFromHere()
    {
    	$thumbnailPath = $this->thumbnail_path;
    	if(substr($thumbnailPath, 0, 7) === 'images/')
    	{
    		return '/'.$this->thumbnail_path;
    	}

    	return $this->thumbnail_path;
    }

}
