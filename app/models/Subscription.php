<?php

class Subscription extends \Eloquent {
	protected $fillable = ['user_id', 'is_recurring', 'is_active', 'first_name', 
						   'last_name', 'email', 'city', 'zip', 'state', 'company_name',
						   'company_address', 'company_id', 'company_zip', 'company_state',
						   'company_city', 'expires_at'];

	public function user()
    {
        return $this->belongsTo('User');
    }

    public function payment()
    {
        return $this->hasMany('Payment');
    }

    public function invoice()
    {
        return $this->hasMany('Invoice');
    }
}