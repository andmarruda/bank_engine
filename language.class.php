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

class language{
// ------------ PRIVATE PARAMETERS ------------ //
	/**
		* @name					langs
		* @description-pt-BR	Idiomas da classe
		* @description-en-US	Class's languages
		* @var 					array
	**/
	private $langs=array(
		'en-US' => array(
			'reader_pattern_exception' => 'File is pattern does not exist!',
			'reader_file_path_expcetion' => 'File path is invalid!',
			'splfileobject_not_file' => 'File is invalid!',
			'splfileobject_file_not_readable' => 'File is not readable!',
			'configuration_exception' => 'Implement and follow the rules of the interface configuration to work properly!'
		),

		'pt-BR' => array(
			'reader_pattern_exception' => 'Padrão de arquivo não existe!',
			'reader_file_path_expcetion' => 'Caminho do arquivo é inválido!',
			'splfileobject_not_file' => 'Arquivo não é válido!',
			'splfileobject_file_not_readable' => 'O arquivo não tem permissão de leitura!',
			'configuration_exception' => 'Implemente e siga as regras da interface configuration pro sistema funcionar adequadamente!'
		)
	);

	/**
		* @name 				lang
		* @description-pt-BR 	Idimoa escolhido para saídas
		* @description-en-US 	Chosen language for outputs
	**/
	private $lang;

// ------------ PUBLIC FUNCTIONS ------------ //
	/**
		* @description-pt-BR 		Recebe informações da lingua utilizada
		* @description-en-US 		Receive information of utilized language
		* @version 					1.0.0
		* @access					public
		* @name					`	__construct
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @param 					Instance Of Language
		* @modifyBy					
		* @modifyDescription		
		* @return					void
	**/
	public function __construct(string $lang){
		if(!array_key_exists($lang, $this->langs))
			throw new Exception('This language does not exist! Esse idioma não existe!');

		$this->lang=$lang;
	}

	/**
		* @description-pt-BR		Pega o texto no idimoa escolhido
		* @description-en-US		Get text on chosen language
		* @version					1.0.0
		* @access					public
		* @name					`	get_text
		* @author					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					string $key
		* @return					string
	**/
	public function get_text(string $key) : string
	{
		if(!array_key_exists($key, $this->langs[$this->lang]))
			throw new Exception('Text does not exist! Texto não existe!');

		return (string) $this->langs[$this->lang][$key];
	}
}
?>