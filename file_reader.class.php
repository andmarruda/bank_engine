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
use andmaengine\bank_engine\utilities as utilities;

require_once(__DIR__. '/utilities.class.php');

class file_reader{
// ------------ PRIVATE PARAMETERS ------------ //
	/**
		* @name					file_pattern
		* @description-pt-BR	Padrão de dados do arquivo
		* @description-en-US	File's data pattern
		* @var 					array
	**/
	private $file_pattern=array(
		'text/plan' => 'reader_text_plan'
	);

	/**
		* @name 				file_inforamtion
		* @description-pt-BR 	Informações contidas no arquivo
		* @description-en-US 	File's contained information
	**/
	private $file_information;

	/**
		* @name 				lang
		* @description-pt-BR 	Lingua utilizada nas Exception e retornos
		* @description-en-US 	Utilized language on Exception and return
	**/
	private $lang;

	/**
		* @name 				reader_configuration
		* @description-pt-BR	Configurações do leitor
		* @description-en-US	Reader's configuration
	**/
	private $reader_configuration;

	/**
		* @name 				configuration_class
		* @description-pt-BR 	Classe que contém as configurações de leitura
		* @description-en-US 	Class that contents the reader's configuration
	**/
	private $configuration_class;


// ------------ PRIVATE FUNCTIONS ------------ //
	/**
		* @description-pt-BR 		Lê a linha e converte para array
		* @description-en-US 		Read the line and converts to array
		* @version 					1.0.0
		* @access 					private
		* @name 					read_line_default
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy 				
		* @modifyDescription 		
		* @param 					array[(string) column_name => 'initial_position' => int, 'length' => int, 'type' => string, 'convert' => string, 'decimalLength' => int] $reader_configuration
		* @param 					string $line_content
		* @return 					void
	**/
	private function read_line_default(array $reader_configuration, string $line_content, array $file_information_key) : void
	{
		$line_information = array();

		array_walk($reader_configuration, function($config, $fieldname) use(&$line_information, $line_content){
			$info=substr($line_content, $config['initial_position'] -1, $config['length']);
			if(!isset($config['convert'])){
				$info=utilities::convert_to_type($config['type'], $info);
			} else{
				if(isset($config['date_format']))
					utilities::$date_format=$config['date_format'];

				if(isset($config['decimal_length']))
					utilities::$decimal_length=$config['decimal_length'];

				$func='andmaengine\bank_engine\utilities::convert_'. $config['convert'];
				$info=$func($info);
			}
			$line_information[$fieldname]=$info;
		});

		return $line_information;
	}

	/**
		* @description-pt-BR		Converte a linha do arquivo por posição de substr
		* @description-en-US		Converts the file's line by substr's position
		* @version 					1.0.0
		* @access 					private
		* @name 					reader_default
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy 				
		* @modifyDescription 		
		* @param 					string $line_content
		* @return 					void
	**/
	private function reader_default(string $line_content){
		$configuration_dimensions=$this->configuration_class->get_configuration_dimensions();
		$reader_configuration = $this->reader_configuration;
		$file_information_key = array();

		if(is_array($configuration_dimensions) && sizeof($configuration_dimensions) > 0){
			$continue=true;
			$arrayDim='$actual_file_information';
			$actual_file_information=$this->file_information;

			array_walk($configuration_dimensions, function($dimension, $func) use(&$continue, $line_content, &$reader_configuration, &$file_information_key, &$arrayDim){
				$func = 'andmaengine\bank_engine\utilities::'. $func;
				$dim = $func($dimension, $line_content);
				if($continue && array_key_exists($dim, $reader_configuration)){
					$reader_configuration = $reader_configuration[$dim];
					$file_information_key[]=$dim;
					$arrayDim.='[\''. $dim. '\']';
				}
				else
					$continue = false;
			});

			if($continue)
			{
				$row_information = $this->read_line_default($reader_configuration, $line_content, $file_information_key);
				eval($arrayDim. '[]=$row_information;');
				$this->file_information=$actual_file_information;
			}
		} else{
			$this->file_information[]=$this->read_line_default($reader_configuration, $line_content, $file_information_key);
		}
	}

	/**
		* @description-pt-BR		Converte a linha do arquivo para array em modo text/plan
		* @description-en-US		Converts the file's line to an array on text/plan mode
		* @version 					1.0.0
		* @access 					private
		* @name 					reader_text_plan
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy 				
		* @modifyDescription 		
		* @param 					string $line_content
		* @return 					void
	**/
	private function reader_text_plan(string $line_content) : void
	{
		$this->reader_configuration=$this->configuration_class->get_configuration();
		reset($this->reader_configuration);
		$condition=key($this->reader_configuration);
		switch(strtolower($condition)){
			case 'separator':
				$this->reader_with_separator($line_content);
			break;

			default:
				$this->reader_default($line_content);
		}
	}


// ------------ PUBLIC FUNCTIONS ------------ //
	/**
		* @description-pt-BR 		Recebe informações do idioma utilizada e classe de configurações
		* @description-en-US 		Receive information of utilized language and configuration's class
		* @version 					1.0.0
		* @access					public
		* @name					`	__construct
		* @author 					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @param 					$lang Instance Of Language
		* @param 					$configuration Class with reader's configuration
		* @modifyBy					
		* @modifyDescription		
		* @return					void
	**/
	public function __construct(language $lang, $configuration){
		$this->lang = $lang;

		$class_interface = class_implements($configuration);
		if(in_array('andmaengine\bank_engine\configuration', $class_interface)){
			$this->configuration_class = $configuration;
		} else{
			$errText = $this->lang->get_text('configuration_exception');
			throw new Exception($errText);
		}
	}

	/**
		* @description-pt-BR		Retorna o valor da array com o conteúdo do arquivo
		* @description-en-US		Returns the array's value with file's content
		* @version					1.0.0
		* @access					public
		* @name					`	get_file_information
		* @author					Anderson Matheus Arruda < andmarruda at gmail dot com >
		* @modifyBy					
		* @modifyDescription		
		* @param 					
		* @param 					
		* @return					array[mixed]
	**/
	public function get_file_information(bool $as_json=false)
	{
		return (!$as_json) ? $this->file_information : json_encode($this->file_information);
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
	public function reader(string $file_pattern, string $file_path) : void
	{
		$error=NULL;

		if(is_null($error) && !array_key_exists($file_pattern, $this->file_pattern)){
			$error = 'reader_pattern_exception';
		}

		if(is_null($error) && !file_exists($file_path)){
			$error = 'reader_file_path_expcetion';
		}

		$file_control = new SplFileObject($file_path);
		if(is_null($error) && !$file_control->isFile()){
			$error = 'splfileobject_not_file';
		}

		if(is_null($error) && !$file_control->isReadable()){
			$error = 'splfileobject_file_not_readable';
		}

		if(!is_null($error)){
			$errText = $this->lang->get_text($error);
			throw new Exception($errText);
		}

		$funcname=$this->file_pattern[$file_pattern];
		while(!$file_control->eof())
			$this->$funcname($file_control->fgets());
	}
}
?>