<?php
/**
	* @description-pt-BR	Exemplo de retorno em array
	* @description-en-US	Example of array's return
	* @Category 			andmaengine
	* @Package				andmaengine\bank_engine
	* @Copyright			Copyright (c) 2017-2030
	* @Language 			PHP
	* @Updated To			7.2.0
	* @license				
	* @author				Anderson Matheus Arruda < andmarruda at gmail dot com >
	* @link					
**/

require_once(__DIR__. '/../../configuration/cnab240_e.class.php');
require_once(__DIR__. '/../../file_reader.class.php');

use andmaengine\bank_engine\file_reader as file_reader;
use andmaengine\bank_engine\cnab240_e as cnab240_e;
use andmaengine\bank_engine\language as language;

$cnab = new cnab240_e();
$t=new file_reader(new language('pt-BR'), $cnab);
$file=__DIR__. '/CC1601A00.RET';
$t->reader('text/plan', $file);
var_dump($t->get_file_information(true));
?>