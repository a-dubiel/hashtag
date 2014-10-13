<?php

class SocialProvider extends \Eloquent {
	
	protected $table = 'user_providers';

	public function user()
    {
        return $this->belongsTo('User');
    }
}