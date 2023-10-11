<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" content="Well organized and easy to understand Web building framework with lots of built-in classes and methods.">
        <link rel="icon" href="logo-red.png" type="image/x-icon">
        <title>Raven Framework</title>
        <style>
			body {
				margin: 0px;
				padding: 0px;
			}
			a {
				text-decoration: none;
				color: white;
			}
			.main{
				display: flex;
				justify-content: center;
				margin-top: 10%;
				}
			.main-body{
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
			}
			.heading{
				color: #620303;
				font-size: x-large;
				font-family: 'Nunito', sans-serif;
				text-align: center;
				}
			.heading img {
			    width: 300px;
			    max-width: 300px;
			    opacity: 50%;
			}
			.heading q{
				font-size: 10pt;
			}
			.heading q::before{
				font-size: 15pt;
				font-weight: bold;
			}
			.heading q::after{
				font-size: 15pt;
				font-weight: bold;
			}
			.description{
				font-family: 'Nunito', sans-serif;
				margin: 14px;
				padding: 5px 15px;
				background-color: #620303;
				color: white;
				border-radius: 25px;
				}
			.welcome{
				font-family: 'Nunito', sans-serif;
				text-align: center;
				margin: 14px;
				padding: 5px;
				}
			.navbar{
				background-color: #620303;
				padding: 8px;
				color: #ffffff96;
				width: 100%;
				font-family: 'Nunito', sans-serif;
			}
			.navbar ul{
				display: flex;
				text-decoration: none;
				justify-content: space-between;
				align-items: center;
				padding: 0px 20px;
				margin: 0px;
				list-style: none;
				text-transform: uppercase;
			}
			.navbar ul li{
				margin: 0px;
				padding: 0px;
			}
			.navbar ul li a{
				margin: 0px;
				padding: 0px;
			}
			.navbar ul li p{
				margin: 0px;
				padding: 0px;
			}

        </style>
    </head>
    <body>
		<div class="navbar">
			<ul>
				<li>
					<a href="#">About</a>
				</li>
				<li>
					<a href="#">Documentions</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<div class="main-body">
				<div class="heading">
					<img src="logo-red.png">
					<br>
					<q>Well organized and easy to understand Web building framework with lots of built-in classes and methods</q>
				</div>
				<div class="description">
					<p>Build Something Great With Raven</p>
				</div>
				<div class="welcome">
					<p>Write Less Do More.</p>
				</div>
			</div>
		</div>
    </body>
</html>
