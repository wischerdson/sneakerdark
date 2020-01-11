<?php

namespace Wsn\XmlParser;

class Document
{
	private $reader;
	private $stack = [];

	public function __call($name, $args)
	{
		if (preg_match('/^parse(.*)/i', $name, $matches)) {
			$this->init(strtolower($matches[1]), $args[0]);
		}
	}

	private function init($name, $callback)
	{
		$this->stack[$name][] = $callback;
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

			if ($this->reader->nodeType == \XMLReader::ELEMENT) {
				if (array_key_exists($tagName, $this->stack)) {
					$xmlDom = simplexml_load_string($this->reader->readOuterXml());

					foreach ($this->stack[$tagName] as $key => $value) {
						call_user_func($value, $xmlDom);
					}
				}
			}
		}
	}
}