<?php

if (!$_SERVER['REQUEST_METHOD'] == 'POST'
	|| !isset($_POST['searchBox'])
	|| empty($_POST['searchBox'])) {
exit;
}

if(!isset($_POST['languages'])
|| empty($_POST['languages'])) {
	$_POST['languages'] = 'es';
}

if (!isset($_POST['sortType'])
		|| empty($_POST['sortType'])){
	$_POST['sortType'] = 'relevance';
}

if($_POST['numberOfArticles'] < 1
	|| $_POST['numberOfArticles'] > 500
	|| !isset($_POST['numberOfArticles'])
	|| empty($_POST['numberOfArticles'])){
	$_POST['numberOfArticles'] = 10;
}

// Se valida la entrada de los
// idiomas de Wikipedia para la URL
// en la que se buscarán los artículos.
function checkLang() {
	// Se valida la entrada del lenguaje:
	if (in_array($_POST["languages"],
			array("en","es","it", "fr", "pt"))){
		return true;
	} else {
		return false;
	}
}

// Se valida la entrada del tipo de ordenamiento:
function checkSortType(){
	// Tipos de ordenamiento de Search de la API de Wikipedia:
	// create_timestamp_desc (fecha descendente),
	// relevance (relevancia)
	// 'pageSize' (pide a la API los datos sin ordenar; son ordenados posteriormente)
	// Se valida la entrada del tipo de ordenamiento:
	$sortMode = array('relevance',
										'last_edit_desc',
										'last_edit_asc',
										'pageSizeAsc',
										'pageSizeDes',
										'none');
	if (in_array($_POST["sortType"], $sortMode)) {
		return true;
	} else {
		return false;
	}
}

if (!checkLang() || !checkSortType()) {
	exit;
}

function genURL($params, $endPoint){
	// Se genera la URL con http_build_query():
	if(isset($params) && isset($endPoint)
		&& !empty($params) && !empty($endPoint)) {
			return $endPoint . '?' . http_build_query( $params );
	} else {
		exit;
	}
}

?>