<?php

namespace Wsn\XmlParser;

class Reader
{
	private $filePath = '';


	public function __construct($filePath)
	{
		$this->filePath = $filePath;
	}

	public function start($class, $startElementCallback, $endElementCallback, $dataHandler) {
		$xmlParser = xml_parser_create();
		xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, true);

		$document = new $class;

		xml_set_element_handler($xmlParser, [$document, $startElementCallback], [$document, $endElementCallback]);
		xml_set_character_data_handler($xmlParser, [$document, $dataHandler]);

		$file = fopen($this->filePath, "r");
		$firstReading = true;
		$data = '';

		while (!feof($file) and $file) {
			$symbol = fgetc($file);
			$data .= $symbol;

			if ($symbol != '>')
				continue;

			if ($firstReading) {
				$data = strstr($data, '<?');
				$firstReading = false;
			}

			if (!xml_parse($xmlParser, $data, feof($file))) {
				throw new Exception('XML Error: '.xml_error_string(xml_get_error_code($xmlParser)).' on line '.xml_get_current_line_number($xmlParser), 1);
				break;
			}

			$data = '';
		}

		fclose($file);
		xml_parser_free($xmlParser);
	}
}