<html class='yui3-js-enabled'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/pure-min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<title><?php bloginfo('name'); ?></title>
<body>
<div class="pure-g-r" id="layout">
    <div class="sidebar pure-u" id="sidebar-pure-u" style="float:left">
        <header class="header">
            <hgroup>
                <h1 class="brand-title"><?php bloginfo('name');?></h1>
                <h2 class="brand-tagline"><?php bloginfo('description') ?></h2>
            </hgroup>
	     <div class="pure-menu pure-menu-open" id='nag-menu'>
				<ul>
        				<li><a href="<?php bloginfo('url');?>">首页</a></li>
					<?php 
                        $pages = get_pages(); 
                        foreach ( $pages as $page ) {
                        $li = '<li><a href="' . get_page_link( $page->ID ) . '">';
                        $li .= $page->post_title;
                        $li .= '</a></li>';
                        echo $li;
                        }
                    ?>
			<?php 
                        $categories = get_categories(); 
                        foreach ( $categories as $category ) {
                        $li = '<li><a href="' . get_category_link( $category->term_id ) . '">';
                        $li .= $category->name;
                        $li .= '</a></li>';
                        echo $li;
                        }
                    ?>
    				</ul>
		</div>
        </header>
    </div>