<?php

class FeaturedPost extends \Eloquent {
	protected $fillable = ['board_id', 'post_id', 'user_id','html'];
	protected $table = 'featured_posts';
	protected $touches = array('board');

	public function board()
    {
        return $this->belongsTo('Board');
    }
}