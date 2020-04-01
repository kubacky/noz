<?php foreach ($config as $name => $value): ?>
<input type="hidden" app-base-config="<?= $name ?>" value="<?= $value ?>">
<?php endforeach; ?>
