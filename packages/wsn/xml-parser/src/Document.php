<?php

namespace Wsn\XmlParser;

class Document
{
	private $reader;
	private $stack = [];

	private $openTags = [];
	private $wasText;

	public function __call($name, $args)
	{
		if (preg_match('/^parse(.*)/i', $name, $matches)) {
			$this->init(strtolower($matches[1]), $args[0], $args[1]);
		}
	}

	private function init($name, $pattern, $callback)
	{
		$this->stack[$name][] = [
			'pattern' => $pattern,
			'callback' => $callback,
			'filled' => $this->setNullToPropertiesRecursive($pattern)
		];
	}

	private function setNullToPropertiesRecursive($array)
	{
		foreach ($array as $key => $value) {
			if (gettype($value) == 'array') {
				$array[$key] = $this->setNullToPropertiesRecursive($value);
			}
			if (gettype($value) == 'string') {
				$array[$key] = null;
			}
		}

		return $array;
	}

	public function load($file)
	{
		$this->reader = new \XMLReader();
		$this->reader->open($file);
		return $this;
	}

	public function start()
	{
		while ($this->reader->read()) {
			$tagName = strtolower($this->reader->localName);
			$serialized = implode('.', $this->openTags);

			if ($this->reader->nodeType == \XMLReader::ELEMENT) {
				$serialized = $serialized ? $serialized.'.'.$tagName : $tagName;

				if ($this->reader->hasAttributes) {
					$this->reader->moveToFirstAttribute();
					$this->push($serialized.':'.$this->reader->name, $this->reader->value);

					while ($this->reader->moveToNextAttribute()) {
						$this->push($serialized.':'.$this->reader->name, $this->reader->value);
					}

					$this->reader->moveToElement();
				}
				if ($this->reader->isEmptyElement) {
					$this->push($serialized, '');
				} else {
					$this->openTags[] = $tagName;
					$this->wasText = false;
				}
			}
			if ($this->reader->nodeType == \XMLReader::END_ELEMENT) {
				if (!$this->wasText) {
					$this->push($serialized, '');
				}

				foreach ($this->stack as $key => $value) {
					if (preg_match('/(\W|^)'.$key.'(\W|$)/', $serialized)) {
						foreach ($value as $index => $element) {
							call_user_func($element['callback'], $element['filled']);
							$this->stack[$key][$index]['filled'] = $this->setNullToPropertiesRecursive($element['filled']);
						}
					}
				}

				array_pop($this->openTags);
			}
			if ($this->reader->nodeType == \XMLReader::TEXT) {
				$this->wasText = true;
				$this->push($serialized, $this->reader->value);
			}
		}
	}

	private function push($path, $value)
	{
		
	}

	private function arrayReplaceRecursive($array, $array1, $pattern, $replacement) {
		
	}
}