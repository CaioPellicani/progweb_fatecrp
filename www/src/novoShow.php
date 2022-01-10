<?php
	include( 'classShow.php');
	
	$showObj = new Show('', '','','','');
	
	if (isset($_POST['cadastrar'])) {
		$showObj->nomeShow = $_POST['nomeShow'];
		$showObj->localidade = $_POST['localidade'];
		$showObj->descricao = $_POST['descricao'];
		$showObj->capacidade = $_POST['capacidade'];
	
		if( $showObj->validarCampos() ) {
			if( $showObj->sqlInsertNovoShow() ){
				header('Location: index.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">CADASTRAR UM SHOW</h4>
		<form class="white" action="novoShow.php" method="POST">
			
			<label>Nome do Show</label>
			<input 
				type="text" 
				name="nomeShow" 
				value="<?php echo htmlspecialchars( $showObj->nomeShow ) ?>"
			>
            <div class="red-text"><?php echo $showObj->erros['nomeShow'].'</br>'; ?></div>

			<label>Local</label>
			<input 
				type="text" 
				name="localidade" 
				value="<?php echo htmlspecialchars( $showObj->localidade ) ?>"
			>	
            <div class="red-text"><?php echo $showObj->erros['localidade'].'</br>'; ?></div>	

			<label>Descrição</label>
			<input 
				type="text" 
				name="descricao" 
				value="<?php echo htmlspecialchars( $showObj->descricao ) ?>"
			>
			<div class="red-text"><?php echo $showObj->erros['descricao'].'</br>'; ?></div>	

			<label>Capacidade</label>
			<input 
				type="number" 
				min="0" 
				name="capacidade" 
				step="50" 
				value="<?php echo htmlspecialchars( $showObj->capacidade ) ?>"
			>				
			<div class="red-text"><?php echo $showObj->erros['capacidade'].'</br>'; ?></div>

            <div class="center" style="margin-top: 10px;">
				<input
					type="submit" 
					name="cadastrar" 
					value="Cadastrar" 
					class="btn brand z-depth-0 grey darken-4"
				>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>
</html>