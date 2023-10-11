<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" content="Well organized and easy to understand Web building framework with lots of built-in classes and methods.">
        <link rel="icon" href="logo-red.png" type="image/x-icon">
		<script src="resources/js/jquery-3.4.1.min.js"></script>
		<script src="resources/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="resources/css/bootstrap.min.css">
        <title>Raven Framework</title>
    </head>
    <body>
		<div class="container">
			<div class="row my-4">
				<div class="col-12 m-2 p-4 rounded bg-danger text-light text-center">
					<h1>ERROR</h1>
				</div>
				<div class="col-2 p-4"></div>
				<div class="col-8 p-4 rounded bg-danger text-light text-center">
					<p>
					<?php echo($content);?>
					</p>
				</div>
				<div class="col-2 p-4"></div>
			</div>
		</div>
	</body>
</html>
