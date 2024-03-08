<div class="container create">
    <?php
    include_once __DIR__ . '/../templates/site.php';
    ?>

    <div class="container-sm">
        <p class="page-description">Create account</p>

        <?php
        include_once __DIR__ . '/../templates/alerts.php';
        ?>
        <form action="/register" method="post" class="form">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your name" value="<?php echo $user->name ?>">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your email" value="<?php echo $user->email ?>">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password">
            </div>
            <div class="field">
                <label for="password1">Repeat password</label>
                <input type="password" id="password1" name="password1" placeholder="Repeat your password">
            </div>

            <input type="submit" class="button" value="Create account">
        </form>

        <div class="actions">
            <a href="/">Already have an account? Login!</a>
        </div>
    </div>
</div>