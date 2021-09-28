<?php
	$conn = mysqli_connect('db','admin','admin','spetaculo');
	if(!$conn){
		echo 'Erro na conexão: '.mysqli_connect_error();
	}
?>