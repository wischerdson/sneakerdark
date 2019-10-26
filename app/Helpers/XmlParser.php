<?php

namespace App\Helpers;

use App;

class XmlParser {
	private $save = [];
	private $candidateName = '';
	private $candidate = '';

	public function __call($name, $args) {
		$name = strtoupper($name);
		$this->save[$name] = $args[0];
	}

	public function start($xmlFilePath) {
		$xmlParser = xml_parser_create();
		xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, true);
		xml_set_element_handler($xmlParser, [__CLASS__, 'startElement'], [__CLASS__, 'endElement']);
		xml_set_character_data_handler($xmlParser, [__CLASS__, 'dataHandler']);

		$file = fopen($xmlFilePath, "r");
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
	private function startElement($parser, $name, $attrs) {
		$this->currentTag = $name;
		$this->currentTagAttrs = $attrs;

		$candidateIsCurrent = false;

		foreach ($this->save as $key => $value) {
			if ($key == $name) {
				$this->candidateName = $name;
				$this->candidate = '<?xml version="1.0"?>'.$this->serializeTag($name, $attrs);
				$candidateIsCurrent = true;
			}
		}

		if (!$this->candidate) return;
		if ($candidateIsCurrent) return;
		
		$this->candidate .= $this->serializeTag($name, $attrs);
	}
	private function endElement($parser, $name) {
		if (!$this->candidate) return;
		
		$this->candidate .= '</'.$name.'>';

		if ($this->candidateName == $name) {
			$this->returnCandidate($name, $this->candidate);
			$this->candidate = '';
			return;
		}
	}
	private function dataHandler($parser, $data) {
		if (!$this->candidate) return;
		$data = preg_replace('/[<]/', '&lt;', $data);
		$data = preg_replace('/[>]/', '&gt;', $data);
		$data = preg_replace('/[&]/', '&amp;', $data);
		$this->candidate .= $data;
	}

	private function returnCandidate($tag, $content) {
		$content = simplexml_load_string($content);
		($this->save[$tag])($content);
	}

	private function serializeTag($name, $attrs) {
		$attrsSerialized = '';
		foreach ($attrs as $attrKey => $attrValue) {
			$attrsSerialized .= strtolower($attrKey).'="'.$attrValue.'" ';
		}
		return '<'.$name.' '.$attrsSerialized.'>';
	}
}