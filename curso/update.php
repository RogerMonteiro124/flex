
<?php
    require '../banco.php';
    $id_curso = null;
    if ( !empty($_GET['id_curso'])) 
            {
        $id_curso = $_REQUEST['id_curso'];
            }
    
    if ( null==$id_curso ) 
            {
        header("Location: index.php");
            }
    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $nomeErro = null;
        $dataNascimentoErro = null;
        
        $nome = $_POST['nome_curso'];
        $select_professor = $_POST['select_professor'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome))
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
                    $sql = "UPDATE curso  set nome_curso = ?, id_professor = ? WHERE id_curso = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome_curso,$select_professor));
                    Banco::desconectar();
                    header("Location: index.php");
        }
        else 
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM curso where id_curso = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_professor));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$nome = $data['nome_curso'];
        $id_professor = $data['id_professor'];
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
             
                    <form class="form-horizontal" action="update.php?id_curso=<?php echo $id_curso?>" method="post">
                        
                      <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" size="50" type="text"  placeholder="Nome" value="<?php echo !empty($nome)?$nome_curso:'';?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        
                       <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                            <label class="control-label">Professor</label>
                            <div class="controls">

                        <?php
                            $con = new mysqli("localhost", "root", "","flex" ) or die (mysql_error());
                            $query = $con->query("SELECT * FROM professor");
                            ?>
                            <select name="select_professor">
                                <?php while($reg = $query->fetch_array()) { ?>
                                <option value="<?=$reg["id_professor"]?>"> <?=$reg["nome_professor"]?> </option>
                                <?php }?>
                            </select>  
                         </br>       
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Atualizar</button>
                          <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        </div>
                    </form>
                </div>                 
    </div> 
  </body>
</html>

