<html class ='yui3-js-enabled'>
<link rel ="stylesheet" href="<?php echo get_template_directory_uri(); ?>/pure-min.css">
<link rel ="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<title><?php bloginfo('name'); ?></title>
<body>
<div class ="pure-g-r" id="layout">
    <div class ="sidebar pure-u" id="sidebar-pure-u" style="float:left">
        <header class ="header">
            <hgroup>
                <h1 class ="brand-title"><?php bloginfo('name');?></h1>
                <h2 class ="brand-tagline"><?php bloginfo('description') ?></h2>
            </hgroup>
                     <?php 
                     $defaults = array(
                        'theme_location'  => '',
                        'menu'            => '',
                        'container'       => 'div',
                        'container_class' => 'pure-menu pure-menu-open',
                        'container_id' => 'nag-menu',
                        'menu_class' => 'menu',
                        'menu_id'         => '',
                        'depth'           => 1
                    );

                    wp_nav_menu($defaults);
                    ?>
        </header>
    </div>