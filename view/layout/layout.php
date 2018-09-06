<?php
// var_dump(get_defined_vars());
// exit;

?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>

    <?php foreach ($stylesheets as $stylesheet) : ?>
    <link rel="stylesheet" type="text/css" href="<?= $this->asset($stylesheet) ?>">
    <?php endforeach; ?>

</head>
<body>

<?php if ($this->regionHasContent("header")) : ?>
<div class="header-wrap">
    <?php $this->renderRegion("header") ?>
</div>
<?php endif; ?>

<?php if ($this->regionHasContent("navbar")) : ?>
<div class="navbar-wrap">
    <?php $this->renderRegion("navbar") ?>
</div>
<?php endif; ?>

<?php if ($this->regionHasContent("main")) : ?>
<div class="main-wrap container <?= $class ?? '' ?>">
        <?php $this->renderRegion("main") ?>
</div>

<!-- <?php // HACK: Extra closing tag bellow ?>
</div>
<?php endif; ?> -->

<?php if ($this->regionHasContent("footer")) : ?>
<div class="footer-wrap">
    <?php $this->renderRegion("footer") ?>
</div>
<?php endif; ?>

<?php foreach ($scripts as $script) : ?>
<script src="<?= $this->asset($script) ?>"></script>
<?php endforeach; ?>

</body>
</html>
