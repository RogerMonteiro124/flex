<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
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
        </br><div class="container">
            <div clas="span10 offset1">
                <div class="row">
                    <h3 class="well"> Adicionar Curso </h3>
                    <form class="form-horizontal" action="create.php" method="post">
                        
                        <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                            <label class="control-label">Nome</label>
                            <div class="controls">
                                <input size= "50" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                                <?php if(!empty($nomeErro)): ?>
                                    <span class="help-inline"><?php echo $nomeErro;?></span>
                                <?php endif;?>
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

                        <div class="form-actions">
                            <br/>                
                            <button type="submit" class="btn btn-success">Adicionar</button>
                            <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                        
                        </div>
                    </form>
                </div>
        </div>
    </body>
</html>


<?php
    require '../banco.php';
    
    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $nomeErro = null;
        $dataNascimentoErro = null;
        
        $nome_curso = $_POST['nome'];
        $select_professor = $_POST['select_professor'];

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome_curso))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }        
        $dada=date('d-m-y');
        
        
        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO curso (nome_curso,data_criacao,id_professor) VALUES(?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome_curso,$dada,$select_professor));
            if($q){
                echo "ola";
                echo '<div class="alert alert-success">
                    <strong>Success!</strong> Indicates a successful or positive action.
                </div>';
            }else{

                    echo '<div class="alert alert-info">
                    <strong>Success!</strong> Indicates a successful or positive action.
                </div>';

            }
            Banco::desconectar();
            header("Location: index.php");
        }
    }
?>
