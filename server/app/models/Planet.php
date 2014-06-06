<?php

class Planet extends Eloquent
{
	protected $table = 'planets';
	protected $connection = 'gamedb';

	public $timestamps = false;
}