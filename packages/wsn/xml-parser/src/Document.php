<?php

namespace Wsn\XmlParser;

class Document
{
	protected $document = '';
	private $oldDepth = 1;
	private $depth = 0;
	private $parentsIds = [];
	private $triggers = [];
	private $currentElementId = 0;
	private $elementsIds = [0];
	private $elements = [];

	public function load($file)
	{
		$this->document = $file;
		return $this;
	}

	public function download($from, $to, $progressCallback = null)
	{
		$file = fopen($to, 'w');
		fwrite($file, '');

		$curl = curl_init($from);
		curl_setopt($curl, CURLOPT_FILE, $file);
		if (!is_null($progressCallback)) {
			curl_setopt($curl, CURLOPT_NOPROGRESS, false);
			curl_setopt($curl, CURLOPT_PROGRESSFUNCTION, $progressCallback);
		}
		curl_exec($curl);
		curl_close($curl);
		fclose($file);

		$this->load($to);

		return hash_file('md5', $to);
	}

	public function parse($patterns)
	{
		foreach ($patterns as $pattern) {
			$pattern = (object) $pattern;
			$this->triggers[$pattern->trigger][] = $pattern->callback;
		}

		$xmlReader = new Reader($this->document);
		$xmlReader->start(
			__CLASS__,
			'startElement',
			'endElement',
			'dataHandler'
		);
	}

	public function startElement($parser, $tagName, $attrs)
	{
		$id = end($this->elementsIds) + 1;
		$this->elementsIds[] = $id;
		$this->depth++;
		if (!array_key_exists($this->depth, $this->parentsIds)) {
			$this->parentsIds[$this->depth] = $id - 1;
		}
		if ($this->depth < $this->oldDepth) {
			$this->parentsIds[$this->depth] = $id - 1;
		}

		print $id .' -- '. $this->parentsIds[$this->depth] .' -- '. $tagName .' -- '. $this->depth."\n";
		/*$currentElementId = end($this->elementsIds) + 1;
		$this->elementsIds[] = $this->currentElement;
		$this->elements[$currentElementId] = [
			'tagName' => $tagName,
			'attrs' => $attrs
		];


		[
			['id' => 1, 'tagName' => 'yml_catalog', 'attrs' => ['date' => '2020-01-06 19:02'], 'parentId' => null, 'data' => null],
			['id' => 2, 'tagName' => 'shop', 'attrs' => [], 'parentId' => 1, 'data' => null],
			['id' => 3, 'tagName' => 'company', 'attrs' => [], 'parentId' => 1, 'data' => null],
			['id' => 4, 'tagName' => 'url', 'attrs' => [], 'parentId' => 1, 'data' => 'http://bizoutmax.ru/'],
		]*/

		$this->oldDepth = $this->depth;
	}

	public function endElement($parser, $tagName)
	{
		$this->depth--;
	}

	public function dataHandler($parser, $data)
	{
		
	}
}