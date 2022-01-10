<?php

	$conn = mysqli_connect('localhost', 
						$_ENV['MYSQL_USER'], 
						$_ENV['MYSQL_PASSWORD'], 
						$_ENV['MYSQL_DATABASE']);
	if(!$conn){
		echo 'Erro na conexão: '.mysqli_connect_error();
	}

	
?>