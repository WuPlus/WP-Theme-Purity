<div id="sidebar" style="display:block;"> 
    <?php if ( !is_user_logged_in() ) {
        echo "<a id='leftbutton' class='pure-button' href='".wp_login_url($redirect)."'>Login</a>";
        echo "<a id='rightbutton' class='pure-button' href='".wp_registration_url()."'>Register</a>";
    } else {
        # code...
        echo "<a id='leftbutton' class='pure-button' href='".wp_logout_url($redirect)."'>Logout</a>";
        echo "<a id='rightbutton' class='pure-button' href='http://www.wuplus.net/wp/wordpress/wp-admin/'>Admin</a>";
    } ?>
        
	<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar() ) : ?>
	<div class="pure-menu pure-menu-open" id='baritem'>
    <ul>
        <li class="pure-menu-heading">Pages</li>
        <?php 
            $pages = get_pages(); 
            foreach ( $pages as $page ) {
		$li = '<li><a href="' . get_page_link( $page->ID ) . '">';
            $li .= $page->post_title;
            $li .= '</a></li>';
            echo $li;
            }
        ?>
    </ul>
	</div>

    <div class="pure-menu pure-menu-open" id='baritem'>
    <ul>
        <li class="pure-menu-heading">Category</li>
        <?php 
            $categories = get_the_category();
            if ($catagories) {
                foreach ( $catagories as $catagory ) {
                    $li = '<li><a href="' . get_catagory_link( $catagory->term_id ) . '">';
                    $li .= $catagory->name;
                    $li .= '</a></li>';
                    echo $li;
                }
            }
        ?>
    </ul>
    </div>

    <div class="pure-menu pure-menu-open" id='baritem'>
    <ul>
        <li class="pure-menu-heading">最新评论</li>
        <?php 
            $args = array(
                'status' => 'approve',
                'number' => '2',
            );
            $comments = get_comments($args);
            if ($comments) {
                foreach ( $comments as $comment ) {
                    $li = "<li id='cmts'><div>".$comment->comment_author.'</div><p>'.mb_substr($comment->comment_content,0,20).'</p></li>';
                    echo $li;
                }
            }
        ?>
    </ul>
    </div>
	<?php endif; ?>
    <a id="closebutton" class='pure-button' href="javascript:$.pageslide.close();var ui = document.getElementById('sidebar-pure-u');ui.style.display = '';">Close Menu</a>
</div>