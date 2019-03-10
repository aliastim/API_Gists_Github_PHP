<?php
require_once 'Class/gists.php';
$gists = new Gists('aliastim');
$gist = $gists->getGists();
//var_dump($gist);

require("templates/header.php");
/*phpinfo();
die();*/


?>

<div class="section">
    <div class="container">
        <div class="text-center">
            <h1 style="margin-top: 20px; margin-bottom: 20px;" class="titleGists">Liste de Gists</h1>
        </div>
        <div class="list-group">
            <?php foreach ($gist as $value): /*var_dump($value['name'])*/?>
                    <a class="list-group-item list-group-item-action textreview" href="<?= $value['url']?>" target="_blank"><?= $value['name']?>
                            <p>
                                <small>Créé le : <?= $value['created_at']?> |
                                    Mis à jour le : <?= $value['updated_at']?>
                                </small>
                            </p>
                    </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php require("templates/footer.php") ?>

