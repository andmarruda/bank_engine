<?php
namespace andmaengine\bank_engine;
/**
	* @description-pt-BR	Leitor de arquivo de extrato bancário eletrônico
	* @description-en-US	File reader of eletronic bank statement
	* @Category 			andmaengine
	* @Package				andmaengine\bank_engine
	* @Copyright			Copyright (c) 2017-2030
	* @Language 			PHP
	* @Updated To			7.2.0
	* @license				
	* @author				Anderson Matheus Arruda < andmarruda at gmail dot com >
	* @link					
**/

use \SplFileObject;
use \Exception;
use \DateTime;

require_once(__DIR__. '/language.class.php');

final class utilities{
// ------------ PUBLIC PARAMETERS ------------ //
	/**
		* @name					date_format
		* @description-pt-BR	O formato atual da data presente no arquivo
		* @description-en-US	The current format of the date present in the file
		* @var 					string
	**/
	public static $date_format;

	/**
		* @name					decimal_length
		* @description-pt-BR	Quantidade de casas decimais
		* @description-en-US	Number of decimal places
		* @var 					int
	**/
	public static $decimal_length;

// ------------ PUBLIC FUNCTIONS ------------ //
	/**
		* @description-pt-BR 		Converte o valor para o tipo desejado
		* @description-en-US		Converts the value to the desired type
		* @version 					1.0.0
		* @access 					public
		* @name 					convert_to_type
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy 				
		* @modifyDescription 		
		* @param 					string $type
		* @param 					mixed $value
		* @return 					
	**/
	public static function convert_to_type(string $type, $value)
	{
		switch(strtolower($type))
		{
			case 'string':
				return (string) $value;
			break;

			case 'int':
			case 'integer':
				return (int) $value;
			break;

			case 'bool':
			case 'boolean':
				return (bool) $value;
			break;

			case 'float':
				return (float) $value;
			break;

			default:
				return (string) $value;
		}
	}

	/**
		* @description-pt-BR		Recebe dados de entrada para validar tipos
		* @description-en-US		Receive incoming data for type validation
		* @version					1.0.0
		* @access					public
		* @name					`	reader
		* @author					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					string $file_pattern
		* @param 					string $file_path
		* @return					void
	**/
	public static function inline(array $configuration_dimension, string $line_content)
	{
		$value_inline=substr($line_content, $configuration_dimension['initial_position'] -1, $configuration_dimension['length']);
		return self::convert_to_type($configuration_dimension['type'], $value_inline);
	}

	/**
		* @description-pt-BR 		Converte o valor para formato de data do banco de dados
		* @description-en-US 		Converts's the value to database's date format
		* @version 					1.0.0
		* @access 					public
		* @name  					convert_date
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					string $dte
		* @param 					string $output_format
		* @return 					string
	**/
	public static function convert_date($date, $output_format='Y-m-d') : string
	{
		$date=trim($date);
		if($date=='')
			return $date;

		$dt = DateTime::createFromFormat(self::$date_format, $date);
		return $dt->format($output_format);
	}

	/**
		* @description-pt-BR 		Converte o valor para formato de float adicionando ponto decimal
		* @description-en-US 		Converts the value to float format by adding decimal point
		* @version 					1.0.0
		* @access 					public
		* @name  					convert_date
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					string $number
		* @return 					string
	**/
	public static function convert_float_with_decimal($number) : float
	{
		$return = substr($number, 0, self::$decimal_length * -1). '.'. substr($number, self::$decimal_length * -1);
		return (float) $return;
	}
}
?>