<?php

class MongoPlanetPositionCache extends MongoEloquent
{
	protected $collection = 'position_cache';
	protected $connection = 'mongodb';

	public $timestamps = false;
}