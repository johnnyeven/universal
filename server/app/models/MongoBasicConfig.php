<?php

class MongoBasicConfig extends MongoEloquent
{
	protected $collection = 'basic';
	protected $connection = 'mongodb';

	public $timestamps = false;
}