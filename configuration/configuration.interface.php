<?php
namespace andmaengine\bank_engine;
/**
	* @description-pt-BR	Leitor de arquivo de extrato bancário eletrônico
	* @description-en-US	File reader of eletronic bank statement
	* @Category 			andmaengine
	* @Package				andmaengine\bank_engine\configuration
	* @Copyright			Copyright (c) 2017-2030
	* @Language 			PHP
	* @Updated To			7.2.0
	* @license				
	* @author				Anderson Matheus Arruda < andmarruda at gmail dot com >
	* @link					
**/

require_once(__DIR__. '/../file_reader.class.php');

interface configuration{
// ------------ PUBLIC FUNCTIONS ------------ //
	/**
		* @description-pt-BR		Pega o valor das configurações
		* @description-en-US		Get configuration's value
		* @version					1.0.0
		* @access					public
		* @name					`	get_configuration
		* @author					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					
		* @return					array
	**/
	public function get_configuration() : array;

	/**
		* @description-pt-BR		Pega informações para sistema de comparação
		* @description-en-US		Get information for comparison's system
		* @version					1.0.0
		* @access					public
		* @name					`	get_line_validation
		* @author					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					
		* @return					array['function_name' => array['initial_position' => int, 'length' => int, 'type' => string]]
	**/
	public function get_line_validation() : array;

	/**
		* @description-pt-BR		Pega informações para dimensões da configuração
		* @description-en-US		Get information for configuration's dimension
		* @version					1.0.0
		* @access					public
		* @name					`	get_line_validation
		* @author					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					
		* @return					array['function_name' => array['initial_position' => int, 'length' => int, 'type' => string]]
	**/
	public function get_configuration_dimensions() : array;
}


/** ideia de implemento

<?php
        //Enter your code here, enjoy!

$array = array("1" => "PHP code tester Sandbox Online",  
              "foo" => "bar", 5 , 5 => 89009, 
              "case" => "Random Stuff: " . rand(100,999),
              "PHP Version" => phpversion()
              );

$dimensoes = array('1', 'a', 'c', 'z');
$arr='array(';
$arrClose=')';

array_walk($dimensoes, function($dim, $k) use(&$arr, &$arrClose){
    $arr.='\''. $dim. '\' => array(';
    $arrClose.=')';
});

//$arr2=token_get_all($arr.$arrClose, TOKEN_PARSE);
//var_dump($arr2);

$arrFinal = eval("return ". $arr. $arrClose. ";");

var_dump($arrFinal);
**/
?>