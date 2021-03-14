<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
/** @var \App\Data\FullVehiclesDTO $data */

?>
    <main>
        <h1>Редактиране на автомобил</h1>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>

        <form action="edit_vehicle.php?id=<?= $data->getId();?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>

                <tr>
                    <td>Марка</td>
                    <td><input type='text' name='brand' class='form-control' value='<?= $data->getBrand(); ?>'/></td>
                </tr>

                <tr>
                    <td>Модел</td>
                    <td><input type='text' name='model' class='form-control' value='<?= $data->getModel() ?>'/></td>
                </tr>

                <tr>
                    <td>Регистрационен номер</td>
                    <td><input type='text' name='reg_number' class='form-control' value='<?= $data->getRegNumber(); ?>'/></td>
                </tr>

                <tr>
                    <td>Разход на гориво</td>
                    <td><input type='text' name='fuel_consumption' class='form-control' value='<?= $data->getFuelConsumption(); ?>' /></td>
                </tr>
                <tr>
                    <td><label for="officeId">Офис</label></td>
                    <td>
                        <select class="form-control" id="officeId" name="office_id" required="required" >
                            <option id='office_view' value=''>Избери офис..</option>

                            <?php foreach ($data->getOffices() as $office): ?>

                                <option <?= $data->getOfficeId()==$office->getId() ? 'selected = "selected"' : ''?> value="<?=$office->getId();?>"><?=$office->getOfficeName();?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="userId">Куриер</label></td>
                    <td>
                        <select class="form-control" id="userId" name="employee_id" required="required" >
                            <option id='office_view' value=''>Избери куриер...</option>
                            <?php foreach ($data->getUsers() as $employee): ?>

                                <option <?= $data->getEmployeeId()==$employee->getId() ? 'selected = "selected"' : '';?> value="<?=$employee->getId();?>"><?=$employee->getFullName();?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <button type="submit" name="edit" class="btn btn-primary">Обнови</button>
                    </td>
                </tr>

            </table>
        </form>

    </main>

<?php require_once dirname(__FILE__).'/../home/footer.php';
