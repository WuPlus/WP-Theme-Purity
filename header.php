<html class='yui3-js-enabled'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/pure-min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<body>
<div class="pure-g-r" id="layout">
    <div class="sidebar pure-u" id="sidebar-pure-u" style="float:left">
        <header class="header">
            <hgroup>
                <h1 class="brand-title"><?php bloginfo('name');?></h1>
                <h2 class="brand-tagline"><?php bloginfo('description') ?></h2>
            </hgroup>

            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a class="pure-button" href="<?php bloginfo('url');?>">首页</a>
                    </li>
                     <?php 
                        $pages = get_pages(); 
                        foreach ( $pages as $page ) {
                        $li = '<li class="nav-item"><a class="pure-button" href="' . get_page_link( $page->ID ) . '">';
                        $li .= $page->post_title;
                        $li .= '</a></li>';
                        echo $li;
                        }
                    ?>
                </ul>
            </nav>
        </header>
    </div>