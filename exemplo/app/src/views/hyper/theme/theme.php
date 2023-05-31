<!DOCTYPE html>
<html lang="<?= CONF_SITE_LANG ?>">

<head>
    <meta charset="utf-8" />
    <title><?= $this->e($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= CONF_SITE_DESCRIPTION ?>" />
    <meta content="<?= CONF_SITE_AUTHOR ?>" name="author" />

    <!-- Theme Config Js -->
    <script src="<?= js(hyper-config.js)?>"></script>

    <!-- App css -->
    <link href="<?= css(app-saas.min.css) ?>" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="<?= css(icons.min.css)?>" rel="stylesheet" type="text/css" />
</head>

<body>

    <?= $this->section('content') ?>

    <!-- Vendor js -->
    <script src="<?= js(vendor.min.js)?>"></script>
        
    <!-- App js -->
    <script src="<?= js(app.min.js)?>"></script>
</body>

</html>