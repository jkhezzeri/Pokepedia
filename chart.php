<!DOCTYPE html>
<html>
<head>

    <?php include_once('includes/head.php'); ?>
    <link class="css_chart" rel="stylesheet" type="text/css" href="css/chart.css">
    <title>Pokepedia - Chart</title>

</head>
<body>

    <?php include_once('includes/header.php'); ?>

    <!-- Page des tableaux des types -->
    <div class="container">
        <!-- Section des boutons raccourci des tableaux -->
        <div class="chart_nav">
            <div class="chart_nav_title">Tableau des faiblesses et des résistances :</div>
            <!-- Bouton Tableau Général -->
            <div class="chart_nav_general">
                <a href="#tableGeneral">
                    <div class="type_tag general">
                        <?php echo(display_image('images/pokeball.png')); ?>
                        <div class="type_tag_name">
                            Général
                        </div>
                    </div>
                </a>
            </div>
            <!-- Boutons Tableaux des double types -->
            <div class="chart_nav_types">
                <ul>
                    <?php foreach($types as $type) : ?>
                        <li>
                            <a href="#table<?php echo($type['en_name_type']); ?>">
                                <?php echo(display_type_tag($type)); ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <!-- Section de la légende des tableaux -->
        <div class="chart_legends">
            <div class="chart_legends_title">Légende :</div>
            <div class="chart_legend">
                <div class="chart_legend_image normal_effect"></div>
                <div class="chart_legend_name">Neutralité</div>
            </div>
            <div class="chart_legend">
                <div class="chart_legend_image super_effective">× 2</div>
                <div class="chart_legend_name">Faiblesse</div>
            </div>
            <div class="chart_legend">
                <div class="chart_legend_image not_very_effective">× ½</div>
                <div class="chart_legend_name">Résistance</div>
            </div>
            <div class="chart_legend">
                <div class="chart_legend_image no_effect">× 0</div>
                <div class="chart_legend_name">Immunité</div>
            </div>
            <div class="chart_legend">
                <div class="chart_legend_image double_super_effective">× 4</div>
                <div class="chart_legend_name">Double Faiblesse</div>
            </div>
            <div class="chart_legend">
                <div class="chart_legend_image double_not_very_effective">× ¼</div>
                <div class="chart_legend_name">Double Résistance</div>
            </div>
            <div class="chart_legend">
                <div class="chart_legend_image no_exist">—</div>
                <div class="chart_legend_name">Double Type Inexistant</div>
            </div>
        </div>

        <!-- Appel de la fonction qui retourne le tableau général -->
        <?php echo(display_chart($chart, $types, [])); ?>
        <!-- Appel de la fonction qui retourne le tableau d'un double type pour chaque type -->
        <?php foreach($types as $type) : ?>
            <?php echo(display_chart($chart, $types, $type)); ?>
        <?php endforeach ?>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
