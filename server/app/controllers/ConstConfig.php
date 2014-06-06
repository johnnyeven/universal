<?php

class ConstConfig
{
	const USER_LOGIN_SUCCESS = 1001;
	const USER_LOGIN_ERROR_AUTH_FAIL = 1008;
	const USER_LOGIN_ERROR_NO_PARAM = 1009;

	const USER_REGISTER_SUCCESS = 2001;
	const USER_REGISTER_ERROR_DUPLICATED = 2007;
	const USER_REGISTER_ERROR_AUTH_FAIL = 2008;
	const USER_REGISTER_ERROR_NO_PARAM = 2009;
	
	const GET_ROLE_SUCCESS = 3001;
	const GET_ROLE_ERROR_NO_PARAM = 3002;

	const CREATE_ROLE_SUCCESS = 4001;
	const CREATE_ROLE_ERROR_DUPLICATED = 4002;
	const CREATE_ROLE_ERROR_NO_PARAM = 4003;

	const GET_PLANET_SUCCESS = 6001;
	const GET_PLANET_ERROR_NO_PARAM = 6002;
}