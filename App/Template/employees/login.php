<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors  */
?>

<main>
    <h1>Влез в системата</h1>
    <form action="" method="post">
        <div>
            <input type="text" name="username" placeholder="Потребителско име"/>

        </div>

        <div>
            <input type="password" name="password" placeholder="Парола"/>
        </div>
        <?php foreach ($errors as $error): ?>
            <p class="message" style="color: darkred"><?= $error ?></p>
        <?php endforeach; ?>
        <div>
            <button type="submit" name="login">Вход</button>
        </div>

    </form>
</main>

<?php require_once dirname(__FILE__).'/../home/footer.php';