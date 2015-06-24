<?php

namespace Helpers;

/*
 * Classe para manipular validações de dados
 *
 * @author Fabio Assuncao
 * @version 1.0
 * @date 2015-02-02
 */

class Validations {

	public static function cpf($cpf) {
		$d1          = 0;
		$d2          = 0;
		$cpf         = preg_replace("/[^0-9]/", "", $cpf);
		$ignore_list = array(
			'00000000000',
			'01234567890',
			'11111111111',
			'22222222222',
			'33333333333',
			'44444444444',
			'55555555555',
			'66666666666',
			'77777777777',
			'88888888888',
			'99999999999',
		);

		if (strlen($cpf) != 11 || in_array($cpf, $ignore_list)) {
			return false;
		} else {
			for ($i = 0; $i < 9; $i++) {
				$d1 += $cpf[$i]*(10-$i);
			}
			$r1 = $d1%11;
			$d1 = ($r1 > 1)?(11-$r1):0;

			for ($i = 0; $i < 9; $i++) {
				$d2 += $cpf[$i]*(11-$i);
			}
			$r2 = ($d2+($d1*2))%11;
			$d2 = ($r2 > 1)?(11-$r2):0;

			return (substr($cpf, -2) == $d1.$d2)?true:false;
		}
	}

# CODIFICA PALAVRAS ATENTUADAS PARA ISO-8859-1
	public static function encodeText($texto){
		$texto = str_replace("á", "&aacute;", $texto);
		$texto = str_replace("à", "&agrave;", $texto);
		$texto = str_replace("â", "&acirc;", $texto);
		$texto = str_replace("ã", "&atilde;", $texto);
		
		$texto = str_replace("Á", "&Aacute;", $texto);
		$texto = str_replace("À", "&Agrave;", $texto);
		$texto = str_replace("Â", "&Acirc;", $texto);
		$texto = str_replace("Ã", "&Atilde;", $texto);
		
		$texto = str_replace("é", "&eacute;", $texto);
		$texto = str_replace("è", "&egrave;", $texto);
		$texto = str_replace("ê", "&ecirc;", $texto);
		
		$texto = str_replace("É", "&Eacute;", $texto);
		$texto = str_replace("È", "&Egrave;", $texto);
		$texto = str_replace("Ê", "&Ecirc;", $texto);
		
		$texto = str_replace("í", "&iacute;", $texto);
		$texto = str_replace("ì", "&igrave;", $texto);
		$texto = str_replace("î", "&icirc;", $texto);
		
		$texto = str_replace("Í", "&Iacute;", $texto);
		$texto = str_replace("Ì", "&Igrave;", $texto);
		$texto = str_replace("Î", "&Icirc;", $texto);
		
		$texto = str_replace("ó", "&oacute;", $texto);
		$texto = str_replace("ò", "&ograve;", $texto);
		$texto = str_replace("ô", "&ocirc;", $texto);
		$texto = str_replace("õ", "&otilde;", $texto);
		
		$texto = str_replace("Ó", "&Oacute;", $texto);
		$texto = str_replace("Ò", "&Ograve;", $texto);
		$texto = str_replace("Ô", "&Ocirc;", $texto);
		$texto = str_replace("Õ", "&Otilde;", $texto);
		

		$texto = str_replace("ó", "&oacute;", $texto);
		$texto = str_replace("ò", "&ograve;", $texto);
		$texto = str_replace("ô", "&ocirc;", $texto);
		$texto = str_replace("õ", "&otilde;", $texto);
		
		$texto = str_replace("ú", "&uacute;", $texto);
		$texto = str_replace("ù", "&ugrave;", $texto);
		$texto = str_replace("û", "&ucirc;", $texto);
		$texto = str_replace("ü", "&uuml;", $texto);
		
		$texto = str_replace("Ú", "&Uacute;", $texto);
		$texto = str_replace("Ù", "&Ugrave;", $texto);
		$texto = str_replace("Û", "&Ucirc;", $texto);
		$texto = str_replace("Ü", "&Uuml;", $texto);
		
		$texto = str_replace("ç", "&ccedil;", $texto);
		$texto = str_replace("Ç", "&Ccedil;", $texto);
		$texto = str_replace("º", "&ordm;", $texto);
		$texto = str_replace("ª", "&ordf;", $texto);
		
		
		return $texto;		
	}

	public static function filter($variavel, $tipo) {
		// Sanitize filters
		// Tipos: email, encoded, quotes, float, int, special_chars, full_special_chars, string, stripped, url, unsafe_raw

		switch ($tipo) {

				// EMAIL => Remove todos caracteres exceto letras, dígitos e #$%&'*+-/=^_`!{|}~@.[].
			case 'email':
				$filter = FILTER_SANITIZE_EMAIL;
				break;

				// ENCODED => Seqüência de URL-codificada, opcionalmente remove ou codifica caracteres especiais.
			case 'encoded':
				$filter = FILTER_SANITIZE_ENCODED;
				break;

			case 'quotes':
				$filter = FILTER_SANITIZE_MAGIC_QUOTES;
				break;

				// NUMBER FLOAT => Remove todos caracteres exceto dígitos, + - e, opcionalmente, eE..
			case 'float':
				$filter = FILTER_SANITIZE_NUMBER_FLOAT;
				break;

				// NUMBER INT => Remove todos caracteres exceto dígitos, mais e sinal de menos.
			case 'int':
				$filter = FILTER_SANITIZE_NUMBER_INT;
				break;

				// ESPECIAL CHARS => HTML-escape '"<> & e caracteres com valor ASCII menor que 32, opcionalmente remove ou codifica outros caracteres especiais.
			case 'special_chars':
				$filter = FILTER_SANITIZE_SPECIAL_CHARS;
				break;

				/*
			FULL ESPECIAL CHARTS => Equivalente a chamar htmlspecialchars () com ENT_QUOTES set. Citações de codificação pode ser desabilitado configurando
			FILTER_FLAG_NO_ENCODE_QUOTES. Como htmlspecialchars (), este filtro está ciente da default_charset e se for detectada uma sequência de bytes que
			compõe um caractere inválido no conjunto atual de caracteres, em seguida, toda a cadeia é rejeitada resultando em uma seqüência de comprimento 0.
			Ao usar esse filtro como um filtro padrão, consulte o seguinte aviso sobre a configuração das bandeiras padrão para 0.
			 */

			case 'full_special_chars':
				$filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS;
				break;

				// STRING => Remove tags, opcionalmente remove ou codifica caracteres especiais.
			case 'string':
				$filter = FILTER_SANITIZE_STRING;
				break;

				// STRIPPED => Alias of "string" filter.
			case 'stripped':
				$filter = FILTER_SANITIZE_STRIPPED;
				break;

				// URL => Remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
			case 'url':
				$filter = FILTER_SANITIZE_URL;
				break;

				// UNSAFE RAW => Do nothing, optionally strip or encode special characters. This filter is also aliased to FILTER_DEFAULT.
			case 'unsafe_raw':
				$filter = FILTER_UNSAFE_RAW;
				break;
		}

		return filter_var($variavel, $filter);
	}

}
