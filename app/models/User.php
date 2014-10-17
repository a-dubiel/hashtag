<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Mmanos\Social\SocialTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SocialTrait;

	protected $fillable = array('name', 'email', 'password');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function provider()
    {
        return $this->hasMany('SocialProvider');
    }

    public function boardConfig()
    {
        return $this->hasMany('BoardConfig');
    }

    public function subscription()
    {
        return $this->hasOne('Subscription');
    }

    public function payment()
    {
        return $this->hasMany('Payment');
    }

    public function notification()
    {
        return $this->hasMany('EmailNotification');
    }



}