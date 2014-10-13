<?php

class Payment extends \Eloquent {
	protected $fillable = ['subscription_id', 'user_id', 'sale_id', 'is_success'];
	protected $touches = ['subscription'];

	public function user()
    {
        return $this->belongsTo('User');
    }

    public function subscription()
    {
        return $this->belongsTo('Subscription');
    }

    public function invoice()
    {
        return $this->hasOne('Invoice');
    }

}