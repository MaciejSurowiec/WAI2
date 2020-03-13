<?php

const REDIRECT_PREFIX ='redirect:';

function dispatch($routing,$url)
{
	$controller_name=$routing[$url];

	$model=[];
	$view_name=$controller_name($model);

	build_response($view_name,$model);
}

function build_response($view,$model)
{
	if(strpos($view,REDIRECT_PREFIX) === 0)
	{
		$ur = substr($view,strlen(REDIRECT_PREFIX));
		header("Location: ".$ur);
		exit;
	}
	else
	{
		render($view,$model);
	}
}

function render($view_name,$model)
{
	global $routing;
	extract($model);
	include 'views/'.$view_name.".php";
}