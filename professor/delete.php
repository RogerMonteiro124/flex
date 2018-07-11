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
    $id_professor = $_POST['id_professor'];


    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM professor where id_professor = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_professor));
    Banco::desconectar();
    header("Location: index.php");
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
                    <h3 class="well">Excluir Contato</h3>
                </div>
                <form class="form-horizontal" action="delete.php" method="post">
                    <input type="hidden" name="id_professor" value="<?php echo $id_professor;?>"/>
                    <div class="alert alert-danger"> Deseja excluir o contato?
                    </div>
                    <div class="form actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="index.php" type="btn" class="btn btn-default">Não</a>
                    </div>
                </form>
            </div>           
        </div>
    </body>    
</html>

