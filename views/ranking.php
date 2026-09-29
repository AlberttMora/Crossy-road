<?php
require_once('api/models/partidaModel.php');

$ranking = partidaModel::ranking();
?>

<?php include('components/css.php') ?>
<?php include('components/navbar.php') ?>

<div class="container py-5">
    <h1>Ranking</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Puntaje</th>
                <th>Duración (s)</th>
            </tr>
        </thead>
        <tbody>
            <?php $posicion = 1; ?>
            <?php foreach ($ranking as $item) { ?>
                <tr>
                    <td><?= $posicion++ ?></td>
                    <td><?= $item->nombre_usuario ?></td>
                    <td><?= $item->puntaje ?></td>
                    <td><?= $item->duracion_segundos ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('components/js.php') ?>