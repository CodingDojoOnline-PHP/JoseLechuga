<?php
	header('Content-type: text/css');
	session_start();
?>

*{
	/*outline: 1px solid red;*/
}
div.container{
	width: 450px;
	height: 600px;
	margin: 0px auto;
}
	div.description{
		width: 200px;
		height: 590px;
		display: inline-block;
		vertical-align: top;
	}
	div.input{
		width: 190px;
		height: 590px;
		display: inline-block;
	}
		div.input input{
			margin-top: 15px;
		}	
div.success, div.errors{
	width: 450px;
	margin: 0px auto;
}
div.errors{
	color: red;
}

<?php
	foreach($_SESSION["errors_textfield_style"] as $error_style)
	{
		echo $error_style;
	}
?>