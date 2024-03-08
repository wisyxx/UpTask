<?php foreach ($alerts as $key => $value) : ?>
    <?php foreach ($value as $alert) : ?>
        <p class="alert <?php echo $key ?>"><?php echo $alert ?></p>
    <?php endforeach; ?>
<?php endforeach; ?>