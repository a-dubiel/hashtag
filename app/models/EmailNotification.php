<?php

class EmailNotification extends \Eloquent {
	protected $fillable = ['user_id', 'subscription_id'];

	public function user()
    {
        return $this->belongsTo('User');
    }
}