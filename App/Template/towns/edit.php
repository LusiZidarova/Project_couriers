<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
/** @var \App\Data\TownDTO $data */

?>
    <main>
        <h1>Редактиране</h1>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>

        <form action="edit_town.php?id=<?= $data->getId();?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>

                <tr>
                    <td>Населено място</td>
                    <td><input type='text' name='name' value='<?= $data->getName(); ?>' class='form-control' /></td>
                </tr>

                <tr>
                    <td>Област</td>
                    <td><input type='text' name='province' value='<?= $data->getProvince(); ?>' class='form-control' /></td>
                </tr>

                <tr>
                    <td>Община</td>
                    <td><input type='text' name='municipality' class='form-control' value='<?=  $data->getMunicipality(); ?>'/></td>
                </tr>

                <tr>
                    <td>Пощенски Код</td>
                    <td><input type="text" name='postcode' class='form-control' value='<?=  $data->getPostcode(); ?>' /></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <button type="submit" name="edit" class="btn btn-primary">Обнови</button>
                    </td>
                </tr>

            </table>
        </form>

    </main>

<?php require_once dirname(__FILE__).'/../home/footer.php';
