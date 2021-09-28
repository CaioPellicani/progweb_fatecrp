<?php
    

    function db_query( $query_script ){
        include('bd_conexao.php');

        //resultado como um conjunto de linhas
        $query_result = mysqli_query($conn, $query_script);
        
        //busca a query
        $array_result = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
        
        //limpa a memória de $result
        mysqli_free_result($query_result);
        
        //fecha a conexão
        mysqli_close($conn);

        return $array_result;
    }
?>