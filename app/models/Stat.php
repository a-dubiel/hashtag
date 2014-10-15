<?php

class Stat extends \Eloquent {
	protected $fillable = ['board_id', 'hits'];

	public function board()
    {
        return $this->belongsTo('Board');
    }
}