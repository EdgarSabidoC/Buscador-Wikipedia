<?php
	include "formValidations.php";

	// Cadena a buscar:
	$searchString = $_POST["searchBox"];

	// Tipo de ordenamiento:
	$sortType = checkSortType();

	// Lenguaje:
	$lang = checkLang();

	// Número de artículos:
	$numberOfArticles = $_POST["numberOfArticles"];

	// Se checa el tipo de ordenamiento:
	if ($sortType != 'pageSizeAsc' && $sortType != 'pageSizeDes') {
		// Parámetros para la generación de la URL (de acuerdo a
		// la documentación oficial):
		$params = [
			"action" => "query",
			"list" => "search",
			"srsearch" => $searchString,
			"srsort" => $sortType ,
			"srlimit" => $numberOfArticles,
			"format" => "json"
		];
	} else {
		// Parámetros para la generación de la URL
		// (de acuerdo a la documentación oficial):
		$params = [
			"action" => "query",
			"list" => "search",
			"srsearch" => $searchString,
			"srsort" => 'none',
			"srlimit" => $numberOfArticles,
			"format" => "json"
		];
	}

	// Enlace de Wikipedia:
	$endPoint = "https://{$lang}.wikipedia.org/w/api.php";

	// Se genera la URL:
	$url =  genURL( $params, $endPoint );

	// Se realiza la petición con file_get_contents() y
	// se decodifica el JSON:
	$results = json_decode( file_get_contents($url), true );

	// Array asociativo que guardo los resultados obtenidos, $wikiPages['pageid']:
	$wikiPages = [];

	// Si se decidió ordenar por tamaño de página:
	if($sortType === 'pageSizeDes') {
		// Se ordena por tamaño de página de forma descendente:
		usort($results['query']['search'], function ($a, $b) {
			return $b['size'] <=> $a['size'];
		});
	} elseif($sortType === 'pageSizeAsc') {
		// Se ordena por tamaño de página de forma ascendente:
		usort($results['query']['search'], function ($a, $b) {
			return $a['size'] <=> $b['size'];
		});
	}

	// Se guardan los elementos en el array asociativo (pageid, title, size, timestamp):
	foreach($results['query']['search'] as $search){
		$wikiPages[$search['pageid']] = array($search['pageid'],
		$search['title'], $search['size'], $search['timestamp'],
		$search['snippet']);
	}

	// Se generan los párrafos con la información obtenida:
	$numberOfResults = count($results['query']['search']);
	echo "<h2>Los {$numberOfResults} resultados de la búsqueda con las palabras \"{$searchString}\" son:</h2><br><br>";
	$cont = 1; // Contador que sirve para imprimir un emoji para regresar al inicio de la página.
	foreach($wikiPages as $wiki){
		$date = date('d/m/Y H:i:s', strtotime($wiki[3]));
		echo "<p class=\"text\"><span class=\"datum\">Title:</span> {$wiki[1]}<br>" .
		"<span class=\"datum\">Snippet:</span> {$wiki[4]}<br>" .
		"<span class=\"datum\">Size (in bytes):</span> {$wiki[2]}<br>" .
		"<span class=\"datum\">Timestamp:</span> {$date}<br>" .
		"<span class=\"datum\">Link:</span> <a href=\"https://{$lang}.wikipedia.org/?curid=$wiki[0]
			target=\"_blank\"
			rel=\"nofollow\">https://{$lang}.wikipedia.org/?curid=$wiki[0]</a></p><br><br>";
			if ($cont % 10 === 0) {
				echo "<a class=\"emoji\" href=\"index.php#inicio\">⬆️</a>";
			}
			$cont++;
	}
?>