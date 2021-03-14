<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */
?>

<main>
    <h1>Добави населено място</h1>
    <?php foreach ($errors as $error): ?>
        <p class="message" style="color: darkred"><?= $error ?></p>
    <?php endforeach; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Населено място</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>

            <tr>
                <td>Област</td>
                <td><input type='text' name='province' class='form-control' /></td>
            </tr>

            <tr>
                <td>Община</td>
                <td><input type='text' name='municipality' class='form-control' /></td>
            </tr>

            <tr>
                <td>Пощенски код</td>
                <td><input type='text' name='postcode' class='form-control' /></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" name="add" class="btn btn-primary">Добави</button>
                </td>
            </tr>

        </table>
    </form>

</main>

<?php require_once dirname(__FILE__).'/../home/footer.php';