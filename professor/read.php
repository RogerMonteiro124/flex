<?php
    require '../banco.php';
    $id_professor = null;
    if(!empty($_GET['id_professor']))
    {
        $id_professor = $_REQUEST['id_professor'];
    }
    
    if(null==$id_professor)
    {
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
       Banco::desconectar();
    }
?>

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
            <div class="span10 offset1">
                <div class="row">
                    <h3 class="well"> Listar Contatos </h3>
                </div>
                
                <div class="form-horizontal">                   
                    <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['nome_professor'];?>
                            </label>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Data Nascimento</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['data_nascimento'];?>
                            </label>
                        </div>
                    </div>                   
            
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>

