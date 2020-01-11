<?php

function downloadFile($from, $to, $progressCallback = null)
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
}
