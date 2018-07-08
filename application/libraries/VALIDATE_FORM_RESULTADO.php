<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VALIDATE_FORM_RESULTADO   
{
    public function ValidateLargePMM($value)
    {
        $value2 = strlen($value);

        if($value2>0 && $value2<50)
		{
			return "";
		}else 
		{	
			return "Los pmm no pueden estar vacios";
		}
    }
}