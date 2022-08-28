<!DOCTYPE html>
<html lang="es-MX">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible"
				content="IE=edge">
	<meta name="viewport"
				content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Edgar Sabido Cortes">
	<meta name="description"
				content="Buscador de artículos en Wikipedia">
	<meta name="theme-color"
				content="#7fff00">
	<link rel="stylesheet" href="css/styles.css">
	<title>ADA01 | Buscador de artículos en Wikipedia</title>
</head>

<body>
	<header id="inicio">
		<h1 id="title" class="title">Buscador de artículos en Wikipedia</h1>
	</header>
	<hr>

	<form id="buscador" action="" class="form" method="POST"
	action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<input class="searchBox" name="searchBox" type="text"
		placeholder="buscar artículos" required results="0">
		<!-- Listas de selección de idiomas con opciones (para una opción) -->
		<!-- El idioma por defecto es el Español -->
		<hr>
		<select name="languages"
						id="languages"
						required>
			<option value="" selected disabled>Seleccionar un idioma</option>
			<option value="en">English</option>
			<option value="es">Español</option>
			<option value="it">Italiano</option>
			<option value="fr">Française</option>
			<option value="pt">Português</option>
		</select>
		<select name="sortType"
						id="sortType"
						required>
			<option value="" selected disabled>Seleccionar un tipo de ordenamiento</option>
			<option value="rel">Relevancia</option>
			<option value="dateAsc">Fecha Ascendente</option>
			<option value="dateDes">Fecha Descendente</option>
			<option value="pageSizeAsc">Tamaño de página ascendente</option>
			<option value="pageSizeDes">Tamaño de página descendente</option>
			<option value="none">Ninguno</option>
		</select>
		<input class="numberOfArticles"
					type="number" id="numberOfArticles"
					placeholder="Cantidad de artículos"
					name="numberOfArticles" min="1" max="500"
					required>
		<hr>
		<input type="submit" name="submitButton" value="Buscar">
		<input type="reset" value="Reiniciar campos">
	</form>
	<hr>
	<section class="container">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST'
					&& isset($_POST['submitButton'])
					&& !empty($_POST['submitButton'])) {
				require "scripts/script.php";
			}
		?>
	</section>
	<br>
	<hr>
	<footer>
		Creado por <a href="https://github.com/EdgarSabidoC">Edgar Sabido Cortés</a>
	</footer>
</body>
<script src="scripts/reenvio.js"></script>
</html>