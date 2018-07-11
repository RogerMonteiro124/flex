
<?php
    require '../banco.php';
    $id_professor = null;
    if ( !empty($_GET['id_professor'])) 
            {
        $id_professor = $_REQUEST['id_professor'];
            }
    
    if ( null==$id_professor ) 
            {
        header("Location: index.php");
            }
    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $nomeErro = null;
        $dataNascimentoErro = null;
        
        $nome_professor = $_POST['nome'];
        $dataNascimento = $_POST['dataNascimento'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome_professor))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }
        if(empty($dataNascimento))
        {
            $nomeErro = 'Por favor digite Sua data de nascimento!';
            $validacao = false;
        }
        $dada=date('d-m-y');
        
        
        //Inserindo no Banco:
        if($validacao)
                        {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE professor  set nome_professor = ?, data_nascimento = ? WHERE id_professor = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome_professor,$dataNascimento,$id_professor));
                    Banco::desconectar();
                    header("Location: index.php");
        }
        else 
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM professor where id_professor = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_professor));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$nome_professor = $data['nome_professor'];
        $dataNascimento = $data['data_nascimento'];
        Banco::desconectar();
	}
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="navbar-header">
            <a class="navbar-brand" rel="home" href="/flex" title="Buy Sell Rent Everyting">
            <img style="max-width:100px; margin-top: -7px;"
                     src="../img/flexpeak.png">
            </a>
        </div>
        </br>
        </br>
        </br>
        </br>
        </br>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 class="well"> Atualizar Contato </h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id_professor=<?php echo $id_professor?>" method="post">
                        
                      <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" size="50" type="text"  placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                       <div class="control-group <?php echo !empty($dataNascimentoErro)?'error':'';?>">
                        <label class="control-label">Data Nascimento</label>
                        <div class="controls">
                            <input name="dataNascimento" size="80" type="date"  placeholder="dataNascimento" value="<?php echo !empty($dataNascimento)?$dataNascimento:'';?>">
                            <?php if (!empty($dataNascimentoErro)): ?>
                                <span class="help-inline"><?php echo $dataNascimentoErro;?></span>
                            <?php endif; ?>
                        </div>
                       </div>
                        
                      
                        <br/>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Atualizar</button>
                          <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </form>
                </div>                 
    </div> 
  </body>
</html>

