<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>

</head>

<body>

    <header id="masthead" class="site-header">

    <div class="site-branding">

    <div class="wrapper">
    <nav class="navbar navbar-light">
        <a class="navbar-brand" href=""><?php bloginfo('name') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="background-color:transparent;color:white; height:50px; width: 50px; z-index: 999;"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => false,
                'menu_class' => 'navbar-nav mr-auto'
            ])
            ?>
            <?php /* get_search_form() 
            ?= echo */ ?>
        </div>
    </nav>

    <div class="navigation">
        <div class="line">
            <div class="number"><p><a href="#section1" style="color: white;
            text-decoration: none;">01</a></p></div>
        </div>
        <div class="line">
            <div class="number"><p><a href="#section2" style="color: white;
            text-decoration: none;">02</a></p></div>
        </div>
        <div class="line">
            <div class="number"><p><a href="#section3" style="color: white;
            text-decoration: none;">03</a></p></div>
        </div>
    </div>

    <section id="section04" class="demo">
        <a href="#section1"><span></span></a>
    </section>

    </div>
</header>