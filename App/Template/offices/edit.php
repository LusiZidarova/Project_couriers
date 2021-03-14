<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
/** @var \App\Data\EditOfficeDTO $data */
?>
    <main>
        <h1>Редактиране</h1>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>

        <form action="edit_office.php?id=<?= $data->getId();?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>

                <tr>
                    <td>Име на офис</td>
                    <td><input type='text' name='office_name' class='form-control' value='<?= $data->getOfficeName(); ?>'/></td>
                </tr>

                <tr>
                    <td>Управител</td>
                    <td><input type='text' name='manager' class='form-control' value='<?= $data->getManager(); ?>'/></td>
                </tr>

                <tr>
                    <td>Адрес</td>
                    <td><input type='text' name='address' class='form-control' value='<?= $data->getAddress(); ?>'/></td>
                </tr>

                <tr>
                    <td>Телефон</td>
                    <td><input type='text' name='phone' class='form-control' value='<?= $data->getPhone(); ?>' /></td>
                </tr>
                <tr>
                    <td>Работно време</td>
                    <td >
                        <textarea  class="form-control" rows="5"  name="working_hours" placeholder="Работно време"><?= $data->getWorkingHours(); ?></textarea>

                    </td>
                </tr>
                <tr>
                    <td><label for="townId">Населено място</label></td>
                    <td>
                        <select class="form-control" id="townId" name="town_id" required="required" >
                            <option id='town_view' value=''>Избери населено място..</option>
                            <?php foreach ($data->getTowns() as $town): ?>

                                <option <?= $data->getTownId()==$town->getId() ? 'selected = "selected"' : ''?> value="<?=$town->getId();?>"><?=$town->getName();?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
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
