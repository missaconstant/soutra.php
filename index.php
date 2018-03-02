<!--
/**#################################################################
    SOUTRA.PHP , PHP CRUD creator
    Copyright (C) 2016  FABLAB AYIYIKOH, www.ayiyikoh.org
    SOUTRA.PHP is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SOUTRA.PHP is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SOUTRA.PHP.  If not, see <http://www.gnu.org/licenses/>.
		fablab@ayiyikoh.org

####################################################################**/
-->
<!DOCTYPE html>
<html>
	<head>
		<title>Generateur</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="moteur/scripts/bs3.3/css/bootstrap.min.css">
		<script type="text/javascript" src="moteur/scripts/do_more.js"></script>

		<style type="text/css">
			body, html{
				height: 100%;
				background: #f1f1f1;
			}
			div.box{
				position: absolute;
				width: 350px;
				background: #fff;
				padding: 10px;
				box-shadow: 0px 0px 2px 1px #ddd;
				border-radius: 7px;
				opacity: 0;
			}
			div.input-group{ margin-bottom: 10px; }
			h1.ic{ font-size: 5em; margin-bottom: 20px; color: #5CB85C; }
			h2{
				font-weight:600;
				width: 150px;
				margin: auto;
				margin-bottom:40px;
				margin-top:10px;
			}
			/**/
			div.formbox {
				width: 400px;
				margin: auto;
				position: absolute;
				top: 50%; left: 50%;
				transform: translate(-50%,-50%);
			}

			div.formbox .logohead {
				padding: 20px;
				/*background: #fff;
				box-shadow: 1px 2px 7px 0px #ddd;*/
				
				min-height: 70px;
				margin-bottom: 20px;
			}

			div.formbox .logohead h2 {
				font-size: 3em;
				margin: 0;
				text-align: center;
				width: 100%;
			}

			div.formbox .logohead h2 span {
				color: #5CB85C;
			}

			div.formbox .server {
				padding: 20px;
				background: #fff;
				box-shadow: 1px 2px 7px 0px #ddd;
				box-sizing: border-box;
				margin-bottom: 10px;
				border: none;
				width: 100%;
				word-wrap: break-word;
			}

			div.formbox .server.error {
				border-left: 4px solid #de6632;
			}

			div.formbox .server.success {
				border-left: 4px solid #5CB85C;
			}

			div.formbox form {
				padding: 20px;
				background: #fff;
				box-shadow: 1px 2px 7px 0px #ddd;
			}

			div.formbox form .form-group {
				position: relative;
				margin-bottom: 20px;
			}

			div.formbox form .form-group:last-child {
				margin-bottom: 0;
			}

			div.formbox form .form-group label {
				font-size: 13px;
				position: absolute;
				height: 100%;
				width: 50px;
				background: #ddd;
				line-height: 55px;
				text-align: center;
			}

			div.formbox form .form-group input {
				border: 1px solid #ddd;
				background: #F7F7F7;
				width: 100%;
				box-sizing: border-box;
				padding: 15px 15px;
				padding-left: 55px;
			}

			div.formbox form .form-group button[type="submit"] {
				border: none;
				background: #5CB85C;
				color: #fff;
				width: 100%;
				padding: 15px;
				font-size: 13px;
				font-size: 14px;
				box-sizing: border-box;
			}

			div.formbox .copyleft {
				color: #555;
				font-size: 14px;
				margin-top: 15px;
			}

			div.formbox .copyleft i {
				color: #5CB85C;
			}

			a {
				color: #5CB85C;
			}
		</style>
	</head>
	<body>

		<div class="formbox">
			<div class="logohead">
				<h2>Soutra<span>{php}</span></h2>
			</div>
			<!--  -->
			<div class="server success">
				I make easier your life (^_^)' !
			</div>
			<!--  -->
			<form action="generateur.php" method="post" id="form">
				<div class="form-group">
					<label><i class="glyphicon glyphicon-cloud"></i></label>
					<input type="text" name="server" placeholder="Database host">
				</div>
				<div class="form-group">
					<label><i class="glyphicon glyphicon-tasks"></i></label>
					<input type="text" name="bd" placeholder="Database name">
				</div>
				<div class="form-group">
					<label><i class="glyphicon glyphicon-user"></i></label>
					<input type="text" name="user" placeholder="Database user name">
				</div>
				<div class="form-group">
					<label><i class="glyphicon glyphicon-lock"></i></label>
					<input type="password" name="pass" placeholder="Database password">
				</div>
				<div class="form-group">
					<button type="submit">Generate</button>
				</div>
			</form>
			<!--  -->
			<p style="text-align: center;" class="copyleft">Avec <i class="glyphicon glyphicon-heart"></i> par <a href="http://ayiyikoh.org">Ayiyikoh</a></p>
		</div>

		<script type="text/javascript">
			window.onload = function(){
				_('#form').onsubmit = function(){
					this.querySelector('button[type="submit"]').textContent = 'Loading ...';
					this.querySelector('button[type="submit"]').setAttribute('disabled','true');

					this.targed(function(data){ console.log(data);
						var response = null;
						if (/Modele/.test(data._text)) {
							response = {error: false, message: "App correctly generated (^_^) !"}
						}
						else {
							var response = JSON.parse(data._text);
						}

						_('.server').classList.add(response.error ? 'error' : 'success');
						_('.server').classList.remove(response.error ? 'success' : 'error');
						_('.server').textContent = response.message;


						_('#form').querySelector('button[type="submit"]').textContent = 'Generate';
						_('#form').querySelector('button[type="submit"]').removeAttribute('disabled');
					}) ;
				} ;
			} ;
		</script>
	</body>
</html>
