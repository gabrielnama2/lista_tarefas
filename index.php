<!--Listar tarefas-->
<?php
require 'config.php';

$lista = [];
$sql = $pdo->query("SELECT * FROM tarefa ORDER BY ordem");
if($sql->rowCount() > 0){
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Bootstrap-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!--Arquivo de estilo .css externo-->
<link href="./style.css" rel="stylesheet">

<div class="container">
    <h1>Lista de Tarefas</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Custo (R$)</th>
            <th>Prazo</th>
            <th>Opções</th>
        </tr>
        <?php foreach($lista as $tarefa):?>
            
            <tr>
                <td><?=$tarefa['id'];?></td>
                <td><?=$tarefa['nome'];?></td>

                <!--Condição de cor-->
                <script>
                    var custo = <?=$tarefa['custo'];?>;
                    document.write("<td id=cor-custo><?=$tarefa['custo'];?></td>");
                    var valor = document.getElementById("cor-custo");

                    if(valor.innerHTML >= 1000){
                        console.log(custo);
                        valor.style.backgroundColor="#FF0000";
                    }
                    else{
                        valor.style.backgroundColor="#1e1e1e";
                    }
                </script>

                <td><?=$tarefa['prazo'];?></td>

                <!--Opções-->
                <td>

                <!--Subir Ordem-->
                <form class="d-inline" method="POST" action="editar_action.php">
                    <input type="hidden" name="id" value="<?=$tarefa['id'];?>"/>
                    <input type="hidden" name="ordem" value="<?=$tarefa['ordem']-1;?>"/>
                    <button id="botao-ordem" type="submit" class="btn btn-outline-info"><img width="30" src="https://cdn-icons-png.flaticon.com/512/3148/3148343.png" alt="Botão subir"></button>
                </form>

                <!--Descer Ordem-->

                <form class="d-inline" method="POST" action="editar_action.php">
                    <input type="hidden" name="id" value="<?=$tarefa['id'];?>"/>
                    <input type="hidden" name="ordem" value="<?=$tarefa['ordem']+1;?>"/>
                    <button id="botao-ordem" type="submit" class="btn btn-outline-danger"><img width="30" src="https://cdn-icons-png.flaticon.com/512/3148/3148295.png" alt="Botão descer"></button>
                </form>

                <!--Editar-->
                <a href="editar.php?id=<?=$tarefa['id'];?>"><button type="button" class="btn btn-info">Editar</button></a>

                <!-- Modal para excluir -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_excluir">Excluir</button>

                <!-- Modal -->
                <div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir tarefa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Tem certeza, a tarefa será excluída permanentemente?
                    </div>
                    <div class="modal-footer">
                        <a href="excluir.php?id=<?=$tarefa['id'];?>"><button type="button" class="btn btn-danger">Excluir</button></a>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
                </div>
            </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <br>
    <a href="cadastrar.php"><button type="button" class="btn btn-primary">Nova Tarefa</button></a>
</div>