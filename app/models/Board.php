<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Board extends \Eloquent implements StaplerableInterface {

    use EloquentTrait;

	protected $fillable = ['hashtag', 'description', 'avatar', 'cover', 'fb_user', 'tw_user', 'insta_user', 'google_user', 'website_url']; 
	
	public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
            'styles' => [
            'medium' => '300x300',
            'thumbCrop' => '120x120#'
            ]
        ]);

        $this->hasAttachedFile('cover', [
            'styles' => [
            'standard' => '1200x250',
            'standardCrop' => '1200x250#'
            ]
        ]);

        parent::__construct($attributes);
    }

    public function config()
    {
        return $this->hasMany('BoardConfig');
    }

    public function stat()
    {
        return $this->hasMany('Stat');
    }

    public function featuredPost()
    {
        return $this->hasMany('FeaturedPost');
    }

    public function scopeByUserId($query, User $user)
    {
    	return $query->whereHas('config', function($q) use($user){
        	$q->where('user_id', $user->id);
    	});
    }

}