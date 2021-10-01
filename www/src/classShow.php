<?php
class Show {
    public $nomeShow = '';
    public $localidade = '';
    public $descricao = '';
    public $capacidade = '';
	public $erros = array('nomeShow' => '', 'localidade' => '', 'descricao' => '', 'capacidade' => '');

    public function __construct( $_nomeShow, $_localidade, $_descricao, $_capacidade ){
        $this->nomeShow = $_nomeShow ;
        $this->localidade = $_localidade ;
        $this->descricao = $_descricao ;
        $this->capacidade = $_capacidade ;
    }

    function validar(){
		//Verificar nome
		if (empty($this->nomeShow)) {
			$this->erros['nomeShow'] = 'Por gentileza informar um nome.';
		} else {
			if (!preg_match( REGX_CHAR, $this->nomeShow)) {
				$this->erros['nomeShow'] =  'O nome deve conter somente letras.';
				$this->nomeShow = '';
			}
		}

        //Verificar localidade
		if (empty($this->localidade)) {
			$this->erros['localidade'] = 'Por gentileza informar uma localidade.';
		} else {
			if (!preg_match(REGX_CHAR, $this->localidade)) {
				$this->erros['localidade'] =  'A localidade deve conter somente letras.';
				$this->localidade = '';
			}
		}
		//Verificar descricao
		if (empty($this->descricao)) {
			$this->erros['descricao'] = 'Por gentileza informar uma descrição.';
		}
		//Verificar capacidade
		if (empty($this->capacidade)) {
			$this->erros['capacidade'] = 'Por gentileza informar a capacidade máxima.';
		} else {
			if (!preg_match('/^[0-9]*$/', $this->capacidade)) {
				$this->erros['capacidade'] = 'Informar somente números.';
				$this->capacidade = '';
			}
		}
        return $this->erros;
    }
}
?>
