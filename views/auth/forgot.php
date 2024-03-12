<div class="container forgot">
    <?php
    include_once __DIR__ . '/../templates/site.php';
    ?>

    <div class="container-sm">
        <p class="page-description">Recover your access to UpTask</p>
        <?php
        include_once __DIR__ . '/../templates/alerts.php';
        ?>
        <form action="/forgot" method="post" class="form">
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your email">
            </div>

            <input type="submit" class="button" value="Send instructions">
        </form>

        <div class="actions">
            <a href="/">Already have an account? Login!</a>
            <a href="/register">Don't have an account yet? Create one!</a>
        </div>
    </div>
</div>