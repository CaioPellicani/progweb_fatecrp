<?php
    function queryAll( $query_script ){
        include('bd_conexao.php');
        $query_result = mysqli_query($conn, $query_script);
        $array_result = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
        mysqli_free_result($query_result);
        mysqli_close($conn);

        return $array_result;
    }

    function queryAssoc( $query_script ){
        include('bd_conexao.php');
        $query_result = mysqli_query($conn, $query_script);
        $array_result = mysqli_fetch_assoc($query_result);
        mysqli_free_result($query_result);
        mysqli_close($conn);

        return $array_result;
    }

    function sqlTransação( $sql_script ){
        include('bd_conexao.php');
        if (mysqli_query($conn, $sql_script)) {
			return true;
		}
		else{
			echo 'query error: ' . mysqli_error($conn);
			return false;
		}
    }
    function caracteresEspeciaisMySQL( $valor ){
        include('config/bd_conexao.php');
        $id_show = mysqli_real_escape_string($conn, $valor);
    }
?>