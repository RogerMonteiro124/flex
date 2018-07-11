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
        <div class="jumbotron">
        <div class="container">
            <div class="row">
                <h1> Cursos </h1>
            </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                </p>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr style="background-color:red#3399ff">
                            <th>Nome</th>
                            <th>Professor</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT curso.*,professor.* FROM curso,professor WHERE curso.id_professor = professor.id_professor';
                        foreach($pdo->query($sql)as $row)
                        {                
                            echo '<tr>';
                            echo '<td>'. $row['nome_curso'] . '</td>';
                            echo '<td>'. $row['nome_professor'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id_curso='.$row['id_curso'].'">Listar</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id_curso='.$row['id_curso'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id_curso='.$row['id_curso'].'">Excluir</a>';
                            echo '</td>';
                            echo '<tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>                   
                </table>               
            </div>
        </div>
        </div>
    </body>
</html>
