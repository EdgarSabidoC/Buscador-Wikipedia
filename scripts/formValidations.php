<?php

// Se valida que el método utilizado sea POST
// y que la caja de búsqueda no esté vacía:
if (!$_SERVER['REQUEST_METHOD'] == 'POST'
	|| !isset($_POST['searchBox'])
	|| empty($_POST['searchBox'])) {
exit;
}

// Se valida el lenguaje seleccionado,
// el español (es) es el predeterminado.
if(!isset($_POST['languages'])
|| empty($_POST['languages'])) {
	$_POST['languages'] = 'es';
}

// Se valida el tipo de ordenamiento seleccionado,
// ordenamiento por relevancia es el predeterminado.
if (!isset($_POST['sortType'])
		|| empty($_POST['sortType'])){
	$_POST['sortType'] = 'relevance';
}

// Se valida el intervalo de la cantidad
// de artículos que se desean obtener,
// 10 es la cantidad de artículos predeterminados.
if($_POST['numberOfArticles'] < 1
	|| $_POST['numberOfArticles'] > 500
	|| !isset($_POST['numberOfArticles'])
	|| empty($_POST['numberOfArticles'])){
	$_POST['numberOfArticles'] = 10;
}

// Se valida que la entrada de los
// idiomas de Wikipedia para la URL
// en la que se buscarán los artículos
// se encuentre en el listado:
function checkLang() {
	if (in_array($_POST["languages"],
			array("en","es","it", "fr", "pt"))){
		return true;
	} else {
		return false;
	}
}

// Se valida que la entrada de los
// tipos de ordenamiento que se usará
// para los artículos obtenidos
// se encuentre en el listado:
function checkSortType(){
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

// Se valida que los valores del idioma y el tipo
// de ordenamiento existan:
if (!checkLang() || !checkSortType()) {
	exit;
}


// Genera una URL (cadena), recibe un arreglo
// asociativo ($params) y una URL ($endpoint):
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