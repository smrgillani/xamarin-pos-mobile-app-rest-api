<?php


function code()
{	
	return str_replace(['$','/', '.'], [''], bcrypt(time()));	
}