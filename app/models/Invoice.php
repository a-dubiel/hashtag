<?php

class Invoice extends \Eloquent {
	protected $fillable = ['user_id', 'subscription_id', 'payment_id', 'path', 'token', 'type'];

	public function subscription()
    {
        return $this->belongsTo('Subscription');
    }

    public function payment()
    {
        return $this->belongsTo('Payment');
    }
}