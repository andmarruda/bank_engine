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

require_once(__DIR__. '/configuration.interface.php');

final class cnab240_e implements configuration{
// ------------ PRIVATE PARAMETERS ------------ //
	/**
		* @name					configuration
		* @description-pt-BR	Configuração do padrão CNAB 240 Segmento E
		* @description-en-US	Pattern's configuration of CNAB 240 Segment E
		* @var 					array
	**/
	private $configuration=array(
		'1' => array(
			'banco' => array(
				'initial_position' => 1,
				'length' => 3,
				'type' => 'int'
			),

			'lote' => array(
				'initial_position' => 4,
				'length' => 4,
				'type' => 'int'
			),

			'registro' => array(
				'initial_position' => 8,
				'length' => 1,
				'type' => 'int'
			),

			'operacao' => array(
				'initial_position' => 9,
				'length' => 1,
				'type' => 'string'
			),

			'servico' => array(
				'initial_position' => 10,
				'length' => 2,
				'type' => 'int'
			),

			'forma_lancamento' => array(
				'initial_position' => 12,
				'length' => 2,
				'type' => 'int'
			),

			'layout_lote' => array(
				'initial_position' => 14,
				'length' => 3,
				'type' => 'int'
			),

			'cnab' => array(
				'initial_position' => 17,
				'length' => 1,
				'type' => 'string'
			),

			'tipo_inscricao' => array(
				'initial_position' => 18,
				'length' => 1,
				'type' => 'int'
			),

			'numero_inscricao' => array(
				'initial_position' => 19,
				'length' => 14,
				'type' => 'int'
			),

			'convenio' => array(
				'initial_position' => 33,
				'length' => 20,
				'type' => 'string'
			),

			'numero_agencia' => array(
				'initial_position' => 53,
				'length' => 5,
				'type' => 'int'
			),

			'dv_agencia' => array(
				'initial_position' => 58,
				'length' => 1,
				'type' => 'string'
			),

			'numero_conta' => array(
				'initial_position' => 59,
				'length' => 12,
				'type' => 'string'
			),

			'dv_conta' => array(
				'initial_position' => 71,
				'length' => 1,
				'type' => 'string'
			),

			'dv_banco' => array(
				'initial_position' => 72,
				'length' => 1,
				'type' => 'string'
			),

			'nome_empresa' => array(
				'initial_position' => 73,
				'length' => 30,
				'type' => 'string'
			),

			'cnab2' => array(
				'initial_position' => 103,
				'length' => 40,
				'type' => 'string'
			),

			'data_saldo' => array(
				'initial_position' => 143,
				'length' => 8,
				'type' => 'int',
				'convert' => 'date',
				'date_format' => 'dmY'
			),

			'valor' => array(
				'initial_position' => 151,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'situacao' => array(
				'initial_position' => 169,
				'length' => 1,
				'type' => 'string'
			),

			'status' => array(
				'initial_position' => 170,
				'length' => 1,
				'type' => 'string'
			),

			'tipo_moeda' => array(
				'initial_position' => 171,
				'length' => 3,
				'type' => 'string'
			),

			'sequencia_extrato' => array(
				'initial_position' => 174,
				'length' => 5,
				'type' => 'int'
			),

			'cnab3' => array(
				'initial_position' => 179,
				'length' => 62,
				'type' => 'string'
			)
		),

		'3' => array(
			'banco' => array(
				'initial_position' => 1,
				'length' => 3,
				'type' => 'int'
			),

			'lote' => array(
				'initial_position' => 4,
				'length' => 4,
				'type' => 'int'
			),

			'registro' => array(
				'initial_position' => 8,
				'length' => 1,
				'type' => 'int'
			),

			'n_registro' => array(
				'initial_position' => 9,
				'length' => 5,
				'type' => 'int'
			),

			'segmento' => array(
				'initial_position' => 14,
				'length' => 1,
				'type' => 'string'
			),

			'cnab' => array(
				'initial_position' => 15,
				'length' => 3,
				'type' => 'string'
			),

			'tipo_inscricao' => array(
				'initial_position' => 18,
				'length' => 1,
				'type' => 'int'
			),

			'numero_inscricao' => array(
				'initial_position' => 19,
				'length' => 14,
				'type' => 'int'
			),

			'convenio' => array(
				'initial_position' => 33,
				'length' => 20,
				'type' => 'string'
			),

			'numero_agencia' => array(
				'initial_position' => 53,
				'length' => 5,
				'type' => 'int'
			),

			'dv_agencia' => array(
				'initial_position' => 58,
				'length' => 1,
				'type' => 'string'
			),

			'numero_conta' => array(
				'initial_position' => 59,
				'length' => 12,
				'type' => 'int'
			),

			'dv_conta' => array(
				'initial_position' => 71,
				'length' => 1,
				'type' => 'string'
			),

			'dv_banco' => array(
				'initial_position' => 72,
				'length' => 1,
				'type' => 'string'
			),

			'nome_empresa' => array(
				'initial_position' => 73,
				'length' => 30,
				'type' => 'string'
			),

			'cnab2' => array(
				'initial_position' => 103,
				'length' => 6,
				'type' => 'string'
			),

			'natureza' => array(
				'initial_position' => 109,
				'length' => 3,
				'type' => 'string'
			),

			'tipo_complemento' => array(
				'initial_position' => 112,
				'length' => 2,
				'type' => 'int'
			),

			'complemento' => array(
				'initial_position' => 114,
				'length' => 20,
				'type' => 'string'
			),

			'cpmf' => array(
				'initial_position' => 134,
				'length' => 1,
				'type' => 'string'
			),

			'data_contabil' => array(
				'initial_position' => 135,
				'length' => 8,
				'type' => 'int',
				'convert' => 'date',
				'date_format' => 'dmY'
			),

			'data_lancamento' => array(
				'initial_position' => 143,
				'length' => 8,
				'type' => 'int',
				'convert' => 'date',
				'date_format' => 'dmY'
			),

			'valor' => array(
				'initial_position' => 151,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'tipo' => array(
				'initial_position' => 169,
				'length' => 1,
				'type' => 'string'
			),

			'categoria' => array(
				'initial_position' => 170,
				'length' => 3,
				'type' => 'int'
			),

			'codigo_historico' => array(
				'initial_position' => 173,
				'length' => 4,
				'type' => 'string'
			),

			'historico' => array(
				'initial_position' => 177,
				'length' => 25,
				'type' => 'string'
			),

			'n_documento' => array(
				'initial_position' => 202,
				'length' => 39,
				'type' => 'string'
			)
		),

		'5' => array(
			'banco' => array(
				'initial_position' => 1,
				'length' => 3,
				'type' => 'int'
			),

			'lote' => array(
				'initial_position' => 4,
				'length' => 4,
				'type' => 'int'
			),

			'registro' => array(
				'initial_position' => 8,
				'length' => 1,
				'type' => 'int'
			),

			'cnab' => array(
				'initial_position' => 9,
				'length' => 17,
				'type' => 'string'
			),

			'tipo_inscricao' => array(
				'initial_position' => 18,
				'length' => 1,
				'type' => 'int'
			),

			'numero_inscricao' => array(
				'initial_position' => 19,
				'length' => 14,
				'type' => 'int'
			),

			'convenio' => array(
				'initial_position' => 33,
				'length' => 20,
				'type' => 'string'
			),

			'numero_agencia' => array(
				'initial_position' => 53,
				'length' => 5,
				'type' => 'int'
			),

			'dv_agencia' => array(
				'initial_position' => 58,
				'length' => 1,
				'type' => 'string'
			),

			'numero_conta' => array(
				'initial_position' => 59,
				'length' => 12,
				'type' => 'int'
			),

			'dv_conta' => array(
				'initial_position' => 71,
				'length' => 1,
				'type' => 'string'
			),

			'dv_banco' => array(
				'initial_position' => 72,
				'length' => 1,
				'type' => 'string'
			),

			'cnab2' => array(
				'initial_position' => 73,
				'length' => 16,
				'type' => 'string'
			),

			'valor_bloqueado_acima_24h' => array(
				'initial_position' => 89,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'valor_limite' => array(
				'initial_position' => 107,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'valor_bloqueado_ate_24h' => array(
				'initial_position' => 125,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'data' => array(
				'initial_position' => 143,
				'length' => 8,
				'type' => 'int',
				'convert' => 'date',
				'date_format' => 'dmY'
			),

			'valor_saldo' => array(
				'initial_position' => 151,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'situacao' => array(
				'initial_position' => 169,
				'length' => 1,
				'type' => 'string'
			),

			'status' => array(
				'initial_position' => 170,
				'length' => 1,
				'type' => 'string'
			),

			'qtde_registros' => array(
				'initial_position' => 171,
				'length' => 6,
				'type' => 'int'
			),

			'valor_debitos' => array(
				'initial_position' => 177,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'valor_creditos' => array(
				'initial_position' => 195,
				'length' => 18,
				'type' => 'float',
				'decimal_length' => 2,
				'convert' => 'float_with_decimal'
			),

			'cnab3' => array(
				'initial_position' => 213,
				'length' => 28,
				'type' => 'string'
			)
		)
	);

	/**
		* @name 				line_validation
		* @description-pt-BR 	Válida se a linha é no padrão esperado
		* @description-en-US 	Valid if the line is in the expected pattern
	**/
	private $line_validation=array();

	/**
		* @name 				configuration_dimensions
		* @description-pt-BR 	Onde o programa pega a chave das configurações
		* @description-en-US 	Where the program get configuration's key
	**/
	private $configuration_dimensions=array(
		'inline' => array(
			'initial_position' => 8,
			'length' => 1,
			'type' => 'string'
		)
	);

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
	public function get_configuration() : array
	{
		return $this->configuration;
	}

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
	public function get_line_validation() : array
	{
		return $this->line_validation;
	}

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
	public function get_configuration_dimensions() : array
	{
		return $this->configuration_dimensions;
	}
}
?>