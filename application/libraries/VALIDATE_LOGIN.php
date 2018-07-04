<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VALIDATE_LOGIN 
{
    public function ValidateLastNumberRut($value)
    {
        $value2=strtoupper(substr($value,-1));

        if($value2 == "1"  || $value2 == "2" || $value2 == "3" || $value2 == "4" || $value2 == "5" || $value2 == "6" || $value2 == "7" || $value2 == "8" || $value2 == "9" || $value2 == "0" || $value2 == 'K')
        {
            return "";
        }else 
        {
            return "el ultimo digito del rut debe ser un numero o una K ";
        }
    }

    public function ValidateNumberRut($value)
    {
        $number1=strtoupper(substr($value,0,1));
        $number2=strtoupper(substr($value,1,1));
        $number3=strtoupper(substr($value,2,1));
        $number4=strtoupper(substr($value,3,1));
        $number5=strtoupper(substr($value,4,1));
        $number6=strtoupper(substr($value,5,1));
        $number7=strtoupper(substr($value,6,1));
        $number8=strtoupper(substr($value,7,1));

        if($number1 == "1"  || $number1 == "2" || $number1 == "3" || $number1 == "4" || $number1 == "5" || $number1 == "6" || $number1 == "7" || $number1 == "8" || $number1 == "9" || $number1 == "0")
        {
            if($number2 == "1"  || $number2 == "2" || $number2 == "3" || $number2 == "4" || $number2 == "5" || $number2 == "6" || $number2 == "7" || $number2 == "8" || $number2 == "9" || $number2 == "0")
            {
                if($number3 == "1"  || $number3 == "2" || $number3 == "3" || $number3 == "4" || $number3 == "5" || $number3 == "6" || $number3 == "7" || $number3 == "8" || $number3 == "9" || $number3 == "0")
                {
                    if($number4 == "1"  || $number4 == "2" || $number4 == "3" || $number4 == "4" || $number4 == "5" || $number4 == "6" || $number4 == "7" || $number4 == "8" || $number4 == "9" || $number4 == "0")
                    {
                        if($number5 == "1"  || $number5 == "2" || $number5 == "3" || $number5 == "4" || $number5 == "5" || $number5 == "6" || $number5 == "7" || $number5 == "8" || $number5 == "9" || $number5 == "0")
                        {
                            if($number6 == "1"  || $number6 == "2" || $number6 == "3" || $number6 == "4" || $number6 == "5" || $number6 == "6" || $number6 == "7" || $number6 == "8" || $number6 == "9" || $number6 == "0")
                            {
                                if($number7 == "1"  || $number7 == "2" || $number7 == "3" || $number7 == "4" || $number7 == "5" || $number7 == "6" || $number7 == "7" || $number7 == "8" || $number7 == "9" || $number7 == "0")
                                {
                                    if($number8 == "1"  || $number8 == "2" || $number8 == "3" || $number8 == "4" || $number8 == "5" || $number8 == "6" || $number8 == "7" || $number8 == "8" || $number8 == "9" || $number8 == "0")
                                    {
                                        return "";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return "El rut ingresado no es valido";
    }
    
    public function ValidateLargeRut($value)
    {
        $value2=strlen($value);

        if($value2==9)
        {
            return "";
        }else 
        {
            return "el rut debe de tener 9 digitos, no usar punto ni guíon";
        }
    }

    public function ValidateLargeTelefono($value)
    {
        $value2 = strlen($value);

        if($value2>7 && $value2<9)
		{
			return "";
		}else 
		{	
			return "El largo del numero telefonico debe ser de 8 digitos";
		}
    }

    public function ValidateLargepass($value)
    {
        $value2=strlen($value);

        if($value2>=6 && $value2<100)
        {
            return "";
        }else 
        {
            return "Debe ingresar las tres contraseñas";
        }
    }
}