<div class="container login">
    <?php
    include_once __DIR__ . '/../templates/site.php';
    ?>

    <div class="container-sm">
        <p class="page-description">Login</p>

        <form action="/" method="post" class="form">
            <div class="field">
                <label for="mail">Email</label>
                <input type="email" id="email" name="email" placeholder="Your email" value="<?php ?>">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" value="<?php ?>">
            </div>

            <input type="submit" class="button" value="Login">
        </form>

        <div class="actions">
            <a href="/register">Don't have an account yet? Create one!</a>
            <a href="/forgot">Reset password</a>
        </div>
    </div>
</div>