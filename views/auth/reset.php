<div class="container reset">
    <?php
    include_once __DIR__ . '/../templates/site.php';
    ?>

    <div class="container-sm">
        <p class="page-description">Reset password</p>

        <form action="/" method="post" class="form">
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" value="<?php ?>">
            </div>
            <div class="field">
                <label for="password1">Repeat password</label>
                <input type="password" id="password1" name="password1" placeholder="Repeat your password" value="<?php ?>">
            </div>

            <input type="submit" class="button" value="Login">
        </form>

        <div class="actions">
            <a href="/">Already have an account? Login!</a>
            <a href="/register">Don't have an account yet? Create one!</a>
        </div>
    </div>
</div>