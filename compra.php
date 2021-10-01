<?php

include('config/bd_conexao.php');

$erros = array('qtde_inteira' => '', 'qtde_meia' => '');
$qtde_inteira = $qtde_meia = '';

//Verifica se o parâmetro id_evento foi enviado pelo get_browser
if (isset($_GET['id_evento'])) {
    //Limpa os dados de sql injection
    $id_evento = mysqli_real_escape_string($conn, $_GET['id_evento']);

    //Monta a query
    $sql = "SELECT *
            FROM tb_evento e
            INNER JOIN tb_show s ON (e.id_show = s.id_show)
            WHERE id_evento = $id_evento;";

    //Executa a query e guarda em $result
    $result = mysqli_query($conn, $sql);

    //Busca o resultado em forma de vetor
    $eventos = mysqli_fetch_assoc($result);

    $nomeShow = $eventos['nomeShow'];
    $localidade = $eventos['localidade'];
    $descricao = $eventos['descricao'];
    $capacidade = $eventos['capacidade'];
    $dt_evento = $eventos['dt_evento'];
    $horario = $eventos['horario'];
    $preco = $eventos['preco'];

    mysqli_free_result($result);

    mysqli_close($conn);
}

//Comprar um ingresso
if (isset($_POST['comprar'])) {

    //Verificar quantidades
    $qtde_inteira = $_POST['qtde_inteira'];
    if (!preg_match('/^[0-9]*$/', $qtde_inteira)) {
        $erros['qtde_inteira'] = 'Informar somente números.';
        $qtde_inteira = '';
    }
    $qtde_meia = $_POST['qtde_meia'];
    if (!preg_match('/^[0-9]*$/', $qtde_meia)) {
        $erros['qtde_meia'] = 'Informar somente números.';
        $qtde_meia = '';
    }

    if (array_filter($erros)) {
        //echo 'Erro no formulário';
    } else {
        //Limpando o conteúdo de códigos suspeitos
        $id_evento = mysqli_real_escape_string($conn, $_POST['id_evento']);
        $qtde_inteira = mysqli_real_escape_string($conn, $_POST['qtde_inteira']);
        $qtde_meia = mysqli_real_escape_string($conn, $_POST['qtde_meia']);
        $preco = mysqli_real_escape_string($conn, $_POST['preco']);
        $valor_total = ($qtde_inteira * $preco) + ($qtde_meia * $preco / 2);

        //Criando a query
        $sql = "INSERT INTO tb_venda (id_evento, qtde_inteira, qtde_meia, valor_total)
                VALUE ('$id_evento', '$qtde_inteira', '$qtde_meia', '$valor_total');";

        //Salva no banco de dados
        if (mysqli_query($conn, $sql)) {
            //Sucesso
            header('Location: #');
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }
}

//Retornar à página inicial
if (isset($_POST['voltar'])) {

    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container #757575">
    <h4 class="center">COMPRA DE INGRESSO</h4>
    <form class="white" action="compra.php" method="POST">
        <input type="hidden" name="id_evento" value="<?php echo $id_evento ?>">
        <h5 class="center"><?php echo $nomeShow ?></h5>
        <h6 class="center"><?php echo $localidade ?></h6>
        <label>Descrição</label>
        <p class="black-text"><?php echo $descricao ?></p>
        <div class="row">
            <div class="col s6">
                <label>Dia</label>
                <input class="black-text center" type="date" name="dt_evento" readonly value="<?php echo $dt_evento ?>">
            </div>
            <div class="col s6">
                <label>Horário</label>
                <input class="black-text center" type="time" name="horario" readonly value="<?php echo $horario ?>">
            </div>
        </div>
        <div class="row">
            <div class="col s6 ">
                <label>Preço do Ingresso (R$)</label>
                <input class="black-text center" type="number" name="preco" readonly value="<?php echo $preco ?>">
            </div>
            <div class="col s6 ">
                <label>Ingressos disponíveis</label>
                <input class="black-text center" type="number" name="capacidade" readonly value="<?php echo $capacidade ?>">
            </div>
        </div>

        <div class="card z-depth-0 grey lighten-4">
            <div class="row">
                <h6 class="center">Quantidade de ingressos</h6>
                <div class="col s6 center">
                    <label class="black-text">INTEIRA</label>
                    <input type="number" min="0" name="qtde_inteira" value="0" class="right-align">
                </div>
                <div class="col s6 center">
                    <label class="black-text">MEIA ENTRADA</label>
                    <input type="number" min="0" name="qtde_meia" value="0" class="right-align">
                    <span class="helper-text" data-error="wrong" data-success="right">Estou ciente das regras de compra da meia entrada.</span>
                </div>
            </div>
        </div>
        <div class="center" style="margin-top: 10px;">
            <input type="submit" name="voltar" value="Cancelar" class="btn brand z-depth-0 grey darken-4">
            <input type="submit" name="comprar" value="Comprar" class="btn brand z-depth-0 grey darken-4">
        </div>
    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>