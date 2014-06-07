<?php

class Planet extends Eloquent
{
	protected $table = 'planets';
	protected $connection = 'gamedb';

	public $timestamps = false;

	public function role()
	{
		return $this->belongsTo('Role', 'role_id');
	}
}