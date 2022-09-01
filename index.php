<!DOCTYPE html>
<html lang="es-MX">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible"
				content="IE=edge">
	<meta name="viewport"
				content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Edgar Sabido Cortés">
	<meta name="description"
				content="Buscador de artículos en Wikipedia">
	<meta name="theme-color"
				content="#7fff00">
	<link rel="stylesheet" href="css/styles.css">
	<title>Buscador de artículos en Wikipedia</title>
</head>

<body>
	<header id="inicio">
		<h1 id="title" class="title">Buscador de artículos en Wikipedia</h1>
	</header>
	<hr>

	<form id="buscador" action="" class="form" method="POST"
	action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<input class="searchBox" name="searchBox" type="text"
		placeholder="Buscar en Wikipedia" required results="0">
		<hr>

		<!-- Listas de selección de idiomas con opciones (para una opción) -->
		<!-- El idioma por defecto es el Español -->
		<select name="languages"
						id="languages">
			<option value="" selected disabled>Seleccionar idioma</option>
			<option value="en">English</option>
			<option value="es">Español</option>
			<option value="it">Italiano</option>
			<option value="fr">Française</option>
			<option value="pt">Português</option>
		</select>
		<!-- Listas de selección de tipo de ordenamiento -->
		<!-- Los resultados se ordenan por relevancia de manera predeterminada -->
		<select name="sortType"
						id="sortType">
			<option value="" selected disabled>Ordenar por</option>
			<option value="relevance">Relevancia</option>
			<option value="last_edit_asc">Fecha Ascendente</option>
			<option value="last_edit_desc">Fecha Descendente</option>
			<option value="pageSizeAsc">Tamaño de página ascendente</option>
			<option value="pageSizeDes">Tamaño de página descendente</option>
			<option value="none">Ninguno</option>
		</select>
		<br>

		<!-- Permite seleccionar una cantidad específica de artículos que se quieran obtener -->
		<!-- Mínimo: 1 artículo; Máximo: 500 artículos -->
		<input class="numberOfArticles"
					type="number" id="numberOfArticles"
					placeholder="No. de artículos (500 máx)"
					name="numberOfArticles" min="1" max="500">
		<hr>

		<!-- Botones para envíar la información del formulario y para reiniciar los campos -->
		<input type="submit" name="submitButton" value="Buscar">
		<input type="reset" value="Reiniciar campos">
	</form>
	<hr>

	<!-- Este contenedor se genera a partir del script de PHP -->
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

	<!-- Script del footer de la página -->
	<?php include "scripts/footer.php" ?>
</body>

	<!-- Script que sirve para evitar que el formulario se reenvíe al cargar la página -->
	<script type="text/javascript">
		if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
		}
	</script>
</html>