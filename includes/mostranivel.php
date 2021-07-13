<?php if($_SESSION['user'][0]['nivel_acesso_fk'] == 1){?>

<a href="#" class="badge badge-info mb-1">Administrador - <?= $_SESSION['user'][0]['nome']?></a>

    <?php }else if($_SESSION['user'][0]['nivel_acesso_fk'] == 2){ ?>

<a href="#" class="badge badge-info mb-1">Vendedor - <?= $_SESSION['user'][0]['nome']?></a>

    <?php }else if($_SESSION['user'][0]['nivel_acesso_fk'] == 3){?>

<a href="#" class="badge badge-info mb-1">Master Admin - <?= $_SESSION['user'][0]['nome']?></a>

    <?php }else{?>

<a href="#" class="badge badge-info mb-1">Administrador loja - <?= $_SESSION['user'][0]['nome']?></a>

    <?php }?>