
<?php
require_once dirname(__FILE__).'/../home/header.php';
/** @var array $errors |null */ ?>

<main>
    <h1>Register</h1>

<p class="form-info">Already register?
    <a href="login.php">Login now</a> and have some fun!
</p>
    <form action="" method="post">
        <div>
            <input type="email" name="email" placeholder="Email"/>
        </div>
        <div>

            <input type="text" name="full_name" placeholder="Full name"/>
        </div>
        <div>
            <input type="password" name="password" placeholder="Password"/>
        </div>
        <div>
            <input type="password" name="confirm_password" placeholder="Re-Password"/>
        </div>
        <?php foreach ($errors as $error): ?>
        <p class="message" style="color: darkred"><?= $error ?></p>
            <?php endforeach; ?>
        <div>
            <button type="submit" name="register">Register</button>
        </div>
    </form>
</main>

<?php require_once dirname(__FILE__).'/../home/footer.php';
