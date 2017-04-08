<html>
	<head>
		<title>ABM Test</title>
		<script type="text/javascript" src="js/funciona.js"></script>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<meta charset="UTF-8">
		<style>
			.loader {
				border: 5px solid #f3f3f3; /* Light grey */
				border-top: 5px solid #3498db; /* Blue */
				border-radius: 50%;
				width: 25px;
				height: 25px;
				animation: spin 2s linear infinite;
				display: inline-flex;
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
		</style>
	</head>

	<body>

		<h1>Test</h1>
		<br>
		<div class="container">
			<label for="productId">Id de producto</label>
			<input type="text" name="productId" id="productId" />
			<!--peticiones.Consulta(true) , Se pone True si es busqueda por id y false si es global-->
			<input type="button" class="btn btn-info consult" onclick="peticiones.Consulta(true)" value="CONSULTAR" />
			<br>
			<input type="button" class="btn btn-info see-all" onclick="peticiones.Consulta(false)"  value="VER TODOS" />

		</div>
		<br>
		<!--alert alert-success-->
		<!--alert alert-warning-->
		<!--alert alert-danger-->
		<div id="msj" class=""></div>
		<div id="result">

		</div>

	</body>
</html>
