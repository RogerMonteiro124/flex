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
        </br>
        <div class="container">
            <div clas="span10 offset1">
                <div class="row">
                    <h3 class="well"> Adicionar Professor </h3>
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
                        
                        <div class="control-group <?php echo !empty($dataNascimentoErro)?'error ': '';?>">
                            <label class="control-label">Data Nascimento</label>
                            <div class="controls">
                                <input size="80" name="dataNascimento" type="date" required="" value="<?php echo !empty($dataNascimento)?$dataNascimento: '';?>">                           
                        </div>
                        </div>                       
                        
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
            $sql = "INSERT INTO professor (nome_professor, data_nascimento, data_criacao) VALUES(?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome_professor,$dataNascimento,$dada));
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
