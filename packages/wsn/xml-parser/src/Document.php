<?php

namespace Wsn\XmlParser;

class Document
{
	private $reader;
	private $callbackStack = [];
	private $originals = [];
	private $stack = [];

	public function __call($name, $args)
	{
		$trigger = preg_replace('/parse/i', '', $name);
		$trigger = strtolower($trigger);

	}

	public function load($file)
	{
		$this->reader = new \XMLReader();
		$this->reader->open($this->file);
		return $this;
	}

	public function start()
	{
		while ($this->reader->read()) {
			if ($this->reader->nodeType != \XMLReader::ELEMENT)
				continue;

			$tagName = strtolower($this->reader->localName);

			if (array_key_exists($tagName, $this->callbackStack)) {
				foreach ($this->callbackStack[$tagName] as $value) {
					$parsed = $this->converter($value[0]);
					call_user_func($value[1], $parsed);
				}
			}
		}
	}

	private function converter($pattern)
	{
		$result = [];
		$nextRead = [];
		$parentElement = '';

		foreach ($pattern as $key => $value) {
			if (strtolower($value) == strtolower($parentElement.$this->reader->localName)) {
				$nextRead[] = $key;
			}
			preg_match('/^'.$parentElement.':(.*)/m', $value, $matches);
			if (!empty($matches)) {
				$result[$key] = $this->reader->getAttribute($matches[1]);
			}
		}

		$this->reader->read();
		if ($reader->nodeType == \XMLReader::TEXT) {
			foreach ($nextRead as $value) {
				$result[$value] = $this->reader->value;
			}
		}

		return $result;
	}

	private function event()
	{

	}

	private function getAttrubute()
	{

	}

	private function getText()
	{

	}
}