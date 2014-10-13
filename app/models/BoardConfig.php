<?php

class BoardConfig extends \Eloquent {
	protected $fillable = ['board_id', 'user_id', 'refresh_interval', 'refresh_count', 'is_active', 'has_fb', 'has_tw', 'has_insta', 'has_vine', 'has_google', 'live', 'banned_users', 'filter'];
	protected $table = 'boards_config';
	protected $touches = array('board');

	public function board()
    {
        return $this->belongsTo('Board');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}