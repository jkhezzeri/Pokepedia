<!DOCTYPE html>
<html>
<head>

    <?php include_once('includes/head.php'); ?>
    <link class="css_home" rel="stylesheet" type="text/css" href="css/home.css">
    <title>Pokepedia - Capacités</title>

</head>
<body>

    <?php include_once('includes/header.php'); ?>

    <!-- Page des symboles des statuts de combat et des catégories des capacités -->
    <div class="container">

        <!-- Liste des statuts de combat -->
        <div id="status">
            <?php foreach($status as $statu) : ?>
                <div class="status_tag <?= str_replace(' ', '_', strtolower($statu['en_name_status'])); ?>">
                    <div class="status_tag_left"></div>
                    <div class="status_tag_center">
                        <?php echo(display_image($statu['icon_status'])); ?>
                        <div class="status_tag_name"><?= $statu['name_status']; ?></div>
                    </div>
                    <div class="status_tag_right"></div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- Liste des catégories des capacités -->
        <div id="damages">
            <?php foreach($damages as $damage) : ?>
                <div class="damages_tag <?= strtolower($damage['en_name_damage']); ?>">
                    <?php echo(display_image($damage['icon_damage'])); ?>
                    <div class="damages_tag_name"><?= $damage['name_damage']; ?></div>
                </div>
            <?php endforeach ?>
        </div>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
