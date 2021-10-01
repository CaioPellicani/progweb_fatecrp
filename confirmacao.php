<?php
include('config/bd_conexao.php');

//Verifica se o parâmetro id_evento foi enviado pelo get_browser
if (isset($_GET['id_venda'])) {
    //Limpa os dados de sql injection
    $id_venda = mysqli_real_escape_string($conn, $_GET['id_venda']);

    //Monta a query
    $sql = "SELECT * 
    FROM tb_venda
    WHERE id_venda = $id_venda;";

    //Executa a query e guarda em $result
    $result = mysqli_query($conn, $sql);

    //Busca o resultado em forma de vetor
    $vendas = mysqli_fetch_assoc($result);

    $qtde_inteira = $vendas['qtde_inteira'];
    $qtde_meia = $vendas['qtde_meia'];
    $valor_total = $vendas['valor_total'];

    mysqli_free_result($result);

    mysqli_close($conn);
}



?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include('templates/header.php'); ?>
<div>
    <img src="./assets/spetaculo.jpg" style="width:100%">
</div>
<div class="container">
    <div class="card z-depth-0 grey lighten-3">
        <div class="card-content center">
            <span class="card-title"><b>Confirmação de Venda</b></span>
            <p>Foram adquiridos:</p>
            <p><?php echo $qtde_inteira ?> ingressos do tipo inteiro.</p>
            <p><?php echo $qtde_meia ?> ingressos do tipo meia entrada.</p>
            <p><b>Valor total: R$ <?php echo $valor_total ?></b></p>
        </div>
        <div class="card-action right-align">
            <a class="black-text" href=" index.php">Ok</a> 
        </div>
    </div>

</div>

<?php include('templates/footer.php'); ?>

</html>