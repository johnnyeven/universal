<?php

class Planet extends Eloquent
{
	protected $table = 'buildings';
	protected $connection = 'gamedb';

	public $timestamps = false;
}