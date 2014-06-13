<?php

class Building extends Eloquent
{
	protected $table = 'buildings';
	protected $connection = 'gamedb';

	public $timestamps = false;
}