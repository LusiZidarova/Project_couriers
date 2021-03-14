<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
/** @var \App\Data\EditEmployeeDTO $data */
?>
    <main>
        <h1>Редактиране</h1>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>


        <form action="edit_employee.php?id=<?= $data->getId();?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>

                <tr>
                    <td>Номер </td>
                    <td><input type='text' name='user_number' class='form-control' value='<?= $data->getUserNumber(); ?>'/></td>
                </tr>

                <tr>
                    <td>Потребителско име </td>
                    <td><input type='text' name='username' class='form-control' value='<?= $data->getUsername(); ?>'/></td>
                </tr>


                <tr>
                    <td>Нова парола</td>
                    <td><input type='text' name='password' class='form-control' value=''/></td>
                </tr>
                <tr>
                    <td>Повтори паролата</td>
                    <td><input type='password' name="confirm_password"  class='form-control' value=''/></td>
                </tr>
                <tr>
                    <td>Три имена</td>
                    <td><input type='text' name='full_name' class='form-control' value='<?= $data->getFullName(); ?>' /></td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td><input type='text' name='phone' class='form-control' value='<?= $data->getPhone(); ?>' /></td>
                </tr>
                <tr>
                    <td><label for="officeId">Офис</label></td>
                    <td>
                        <select class="form-control" id="officeId" name="office_id" required="required" >
                            <option  value=''>Избери офис..</option>
                            <?php foreach ($data->getOffices() as $office): ?>

                                <option <?= $data->getOfficeId()==$office->getId() ? 'selected = "selected"' : ''?> value="<?=$office->getId();?>"><?=$office->getOfficeName();?></option>
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
