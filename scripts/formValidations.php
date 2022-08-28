<?php
	if (!$_SERVER['REQUEST_METHOD'] == 'POST'
			|| !isset($_POST['searchBox'])
			|| empty($_POST['searchBox'])
			|| !isset($_POST['languages'])
			|| empty($_POST['languages'])
			|| !isset($_POST['sortType'])
			|| empty($_POST['sortType'])
			|| !isset($_POST['numberOfArticles'])
			|| empty($_POST['numberOfArticles'])) {
				exit;// require "scripts/script.php";
	}

	// Se valida la entrada de los
	// idiomas de Wikipedia para la URL
	// en la que se buscarán los artículos.
	function checkLang() {
		// Se valida la entrada del lenguaje:
		if (in_array($_POST["languages"],
				array("en","es","it", "fr", "pt"))){
			return $_POST["languages"];
		}
	}

	// Se valida la entrada del tipo de ordenamiento:
	function checkSortType(){
		// Tipos de ordenamiento de Search de la API de Wikipedia:
		// create_timestamp_desc (fecha descendente),
		// relevance (relevancia)
		// 'pageSize' (pide a la API los datos sin ordenar; son ordenados posteriormente)
		// Se valida la entrada del tipo de ordenamiento:
		$sortMode = array('rel' => 'relevance',
											'dateDes' => 'last_edit_desc',
											'dateAsc' => 'last_edit_asc',
											'pageSizeAsc' => 'pageSizeAsc',
											'pageSizeDes' => 'pageSizeDes',
											'none' => 'none');
		if (in_array($_POST["sortType"], array_keys($sortMode))) {
			return $sortMode[$_POST["sortType"]];
		}
	}

	function genURL($params, $endPoint){
		// Se genera la URL con http_build_query():
		if(isset($params) && isset($endPoint)
			&& !empty($params) && !empty($endPoint)) {
				return $endPoint . '?' . http_build_query( $params );
			}
	}

?>