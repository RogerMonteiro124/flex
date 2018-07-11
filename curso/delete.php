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
    $id_curso = $_POST['id_curso'];


    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM curso where id_curso = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_curso));
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
                    <input type="hidden" name="id_curso" value="<?php echo $id_curso;?>"/>
                    <div class="alert alert-danger"> Deseja excluir o curso?
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

