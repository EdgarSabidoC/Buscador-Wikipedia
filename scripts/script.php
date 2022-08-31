<?php
	include 'formValidations.php';

	// Cadena a buscar:
	$searchString = $_POST['searchBox'];

	// Tipo de ordenamiento:
	$sortType = $_POST['sortType'];

	// Lenguaje de la Wikipedia:
	$lang = $_POST['languages'];

	// Cantidar de artículos a buscar:
	$numberOfArticles = $_POST['numberOfArticles'];

	// Se checa el tipo de ordenamiento:
	if ($sortType != 'pageSizeDes' && $sortType != 'pageSizeAsc') {
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
		$params = [
			"action" => "query",
			"list" => "search",
			"srsearch" => $searchString,
			"srsort" => 'relevance',
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

	$wikiURL = "https://{$lang}.wikipedia.org/?curid=";

	// Se generan los párrafos con la información obtenida dentro del contenedor:
	$numberOfResults = count($results['query']['search']);
	$sortMode = "";
	switch($_POST['sortType']){
		case 'relevance':
		$sortMode = 'por relevancia';
		break;
		case 'last_edit_asc':
		$sortMode = 'por fecha ascendente';
		break;
		case 'last_edit_desc':
		$sortMode = 'por fecha descendente';
		break;
		case 'pageSizeAsc':
		$sortMode = 'por tamaño de página ascendente';
		break;
		case 'pageSizeDes':
		$sortMode = 'por tamaño de página descendente';
		break;
		case 'none':
		$sortMode = 'sin ningún tipo de ordenamiento';
		break;
	}
	if($numberOfResults > 1) {
		echo "<hr><h2>Los {$numberOfResults} resultados de la búsqueda con las palabras \"{$searchString}\" {$sortMode} son:</h2><br><br>";
	} elseif($numberOfResults == 1) {
		echo "<hr><h2>El {$numberOfResults}er resultado de la búsqueda con las palabras \"{$searchString}\" {$sortMode} es:</h2><br><br>";
	} else {
		echo "<hr><h2>Se encontraron {$numberOfResults} resultados de la búsqueda con las palabras \"{$searchString}\".</h2><br><br>";
	}

	echo "<div class=\"subContainer\">";
	foreach($wikiPages as $wiki){
		$date = date('d/m/Y H:i:s', strtotime($wiki[3]));
		echo "<p class=\"text\"><a onclick=\"window.open(this.href,'_blank');return false;\"
																href=\"{$wikiURL}{$wiki[0]}
																rel=\"nofollow\"
																class=\"datumTitle\">{$wiki[1]}<br></a>" .
		"{$wiki[4]}<br>" .
		"<span class=\"datum\">Tamaño de la página (en bytes):</span><span class=\"data\"> {$wiki[2]}</span><br>" .
		"<span class=\"datum\">Última edición:</span><span class=\"data\"> {$date}</span><br>" .
		"<a class=\"url\" href=\"{$wikiURL}{$wiki[0]}
			rel=\"nofollow\"
			onclick=\"window.open(this.href,'_blank');return false;\">{$wikiURL}{$wiki[0]}</a></p><br><br>";
	}
	echo "</div>";

?>