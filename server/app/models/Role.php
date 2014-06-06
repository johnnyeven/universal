<?php

class Role extends Eloquent
{
	protected $table = 'roles';
	protected $connection = 'gamedb';

	public $timestamps = false;
}