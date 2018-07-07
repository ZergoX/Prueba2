<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VALIDATE_FORM_MUESTRAS 
{
    public function ValidateLargeTemperatura($value)
    {
        $value2 = strlen($value);

        if($value2>1 && $value2<50)
		{
			return "";
		}else 
		{	
			return "Los rango de la temperatura son entre los 1 a 50 °C";
		}
    }

    public function ValidateLargeCantidadMuestras($value)
    {
        $value2 = strlen($value);

        if($value2>=0 && $value2<20)
		{
			return "";
		}else 
		{	
			return "La cantidad de muestras deben ser de menores a 20 y mayor a 0";
		}
    }

    public function ValidateLargeAnalisis($value)
    {
        $value2 = strlen($value);

		if($value2 <50 && $value2>0)
		{
			return "";
		}else 
		{	
			return "Debe agregar un tipo de analisis";
		}
    }



}