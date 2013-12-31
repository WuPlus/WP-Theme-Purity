<div id="sidebar" style="display:block;"> 
    <?php if ( !is_user_logged_in() ) {
        echo "<a id='leftbutton' class='pure-button' href='".wp_login_url($redirect)."'>登录</a>";
        echo "<a id='rightbutton' class='pure-button' href='".wp_registration_url()."'>注册</a>";
    } else {
        # code...
        echo "<a id='leftbutton' class='pure-button' href='".wp_logout_url($redirect)."'>登出</a>";
        echo "<a id='rightbutton' class='pure-button' href='".admin_url()."'>管理</a>";
    } ?>
    <?php 
        $args = array(
            'status' => 'approve',
            'number' => '5',
        );
        $comments = get_comments($args);
	    if ($comments) {
            foreach ( $comments as $comment) {
                if($comment->comment_approved == 1){
                    $post = get_post($comment->comment_post_ID);
                    if($count%2 == 0){
                        $li = "<div class='bubble-box arrow-left'><div class='wrap'>";
                        $li .= "<a href='".$comment->comment_author_url."'>".$comment->comment_author."</a> 在";
                        $li .= "<a href='".get_permalink( $post->ID )."'>".$post->post_title."</a>中说<br />&nbsp";
                        $li .= mb_substr($comment->comment_content,0,20)."</div></div>";
                        echo $li;
                    }else{
                        $li = "<div class='bubble-box arrow-right'><div class='wrap'>";
                        $li .= "<a href='".$comment->comment_author_url."'>".$comment->comment_author."</a> 在";
                        $li .= "<a href='".get_permalink( $post->ID )."'>".$post->post_title."</a>中说<br />&nbsp";
                        $li .= mb_substr($comment->comment_content,0,20)."</div></div>";
                        echo $li;
                    }
                    $count++;
                }
		    } 
        }
     ?>
    <a id="closebutton" class='pure-button' href="javascript:$.pageslide.close();var ui = document.getElementById('sidebar-pure-u');ui.style.display = '';">关闭菜单</a>
</div>