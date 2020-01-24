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

	public function __construct($file)
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
					if ($key == $tagName) {
						foreach ($value as $key1 => $value1) {
							call_user_func($value1['callback'], $value1['filled']);
							$this->stack[$key][$key1]['filled'] = $this->setNullToPropertiesRecursive($value1['pattern']);
						}
					}
				}

				array_pop($this->openTags);
			}
			if ($this->reader->nodeType == \XMLReader::TEXT or $this->reader->nodeType == \XMLReader::CDATA) {
				$this->wasText = true;
				$this->push($serialized, $this->reader->value);
			}
		}
	}

	private function push($path, $value)
	{
		foreach ($this->stack as $key1 => $stackItem) {
			foreach ($stackItem as $key2 => $value1) {
				$this->stack[$key1][$key2]['filled'] = $this->arrayReplaceRecursive($value1['pattern'], $value1['filled'], $path, $value);
			}
		}
	}

	private function arrayReplaceRecursive($array, $array1, $pattern, $replacement) {
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$array1[$key] = $this->arrayReplaceRecursive($value, $array1[$key], $pattern, $replacement);
			}
			if (gettype($value) == 'string') {
				if (preg_match('/'.$value.'$/i', $pattern)) {
					if (is_null($array1[$key])) {
						$array1[$key] = $replacement;
					} else {
						if (is_array($array1[$key]))
							$array1[$key][] = $replacement;
						else {
							$tmp = $array1[$key];
							$array1[$key] = [$tmp];
							$array1[$key][] = $replacement;
						}
					}
				}
			}
		}

		return $array1;
	}
}