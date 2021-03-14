<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
/** @var \App\Data\TownDTO[] $data */
?>

<main>
    <h1>Добави офис</h1>
    <?php foreach ($errors as $error): ?>
        <p class="message" style="color: darkred"><?= $error ?></p>
    <?php endforeach; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Име на офис</td>
                <td><input type='text' name='office_name' class='form-control' /></td>
            </tr>

            <tr>
                <td>Управител</td>
                <td><input type='text' name='manager' class='form-control' /></td>
            </tr>

            <tr>
                <td>Адрес</td>
                <td><input type='text' name='address' class='form-control' /></td>
            </tr>

            <tr>
                <td>Телефон</td>
                <td><input type='text' name='phone' class='form-control' /></td>
            </tr>
            <tr>
                <td>Работно време</td>
                <td >
                    <textarea  class="form-control" rows="5"  name="working_hours" placeholder="Работно време"></textarea>

                </td>
            </tr>
            <tr>
                <td><label for="townId">Населено място</label></td>
                <td>
                    <select class="form-control" id="townId" name="town_id" required="required" >
                        <option id='town_view' value=''>Избери населено място..</option>
                        <?php foreach ($data as $town): ?>
                            <option value="<?=$town->getId();?>"><?=$town->getName();?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <button type="submit" name="add" class="btn btn-primary">Добави</button>
                </td>
            </tr>

        </table>
    </form>

</main>

<?php require_once dirname(__FILE__).'/../home/footer.php';