<?php
    register_nav_menus();
    $args = array(
    'class'         => '',
    'before_widget' => '<li id="%1$s" class="my_widget">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="right_siderbar_subhead">',
    'after_title'   => '</h2>' ); 
    register_sidebar($args);
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 250, 250,ture);

    //page index
    function pagination($query_string){   
    	global $posts_per_page, $paged;   
    	$my_query = new WP_Query($query_string ."&posts_per_page=-1");   
    	$total_posts = $my_query->post_count;   
    	if(empty($paged))
    		$paged = 1;   
    	$prev = $paged - 1;   
    	$next = $paged + 1;   
    	$range = 1; // only edit this if you want to show more page-links   
    	$showitems = ($range * 2)+1;   
    	  
    	$pages = ceil($total_posts/$posts_per_page);   
    	if(1 != $pages){   
    		echo "<ul class='pure-paginator'>";   
    		echo "<li><a class='pure-button prev' href='".get_pagenum_link(1)."'>&#171;</a></li>";   
    		echo ($paged > 1 && $showitems < $pages)? "<li><a class='pure-button prev' href='".get_pagenum_link($prev)."'>&#8249;</a></li>":"";   
    		  
    		for ($i=1; $i <= $pages; $i++){   
    			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){   
    				echo ($paged == $i)? "<li><a class='pure-button pure-button-active' href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li><a class='pure-button' href='".get_pagenum_link($i)."'>".$i."</a></li>";   
    			}   
    		}   
    	  
    		echo ($paged < $pages && $showitems < $pages) ? "<li><a class='pure-button next' href='".get_pagenum_link($next)."'>&#8250;</a></li>" :"";   
    		echo "<li><a class='pure-button next' href='".get_pagenum_link($pages)."'>&#187;</a></li>";   
    		echo "</ul>\n";   
    	}   
    }

    function getPostViews($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0";
        }
        return $count;
    }
    
    function setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }

    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

    function get_post_meta_info($postID){
        $temp1 = "分类";
        $categories = get_the_category($postID);
        if($categories != ''){
            foreach ($categories as $category ) {
                $temp1 .= "<a class='post-category post-category-design' >".$category->name."</a>";
            }  
        } 
        echo $temp1; 
        $temp2 = "标签";
        $count = 0;
        $tags = get_the_tags($postID);
        if($tags == ''){
            $temp2 = "";
        }else{
            foreach ($tags as $tag ) {
                switch ($count%3) {
                    case 0:
                        $temp2 .= "<a class='post-category post-category-pure' >".$tag->name."</a>";
                        break;
                    case 1:
                        $temp2 .= "<a class='post-category post-category-yui' >".$tag->name."</a>";
                        break;
                    case 2:
                        $temp2 .= "<a class='post-category post-category-js' >".$tag->name."</a>";
                        break;
                }
                $count++;
                if ($count > 6) {
                    break;
                }
            }
        }   
        echo $temp2;
    }

    add_action( 'widgets_init', 'my_unregister_widgets' );   

    function my_unregister_widgets() {  
        register_widget( 'purity_fixed_ad_Widget' );
        register_widget( 'purity_unfixed_ad_Widget' );
        register_widget('My_Widget_Recent_Comments');
        unregister_widget( 'WP_Widget_RSS' );
        unregister_widget( 'WP_Widget_Recent_Comments' );
        unregister_widget( 'WP_Widget_Archives' ); 
        unregister_widget( 'WP_Widget_Search' ); 
        unregister_widget( 'WP_Widget_Meta');
    }

    function purity_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php comment_author_link(); ?> <?php edit_comment_link( '编辑', '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
            default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <?php echo get_avatar( $comment, 50);?>
            <div class="comment-meta">
                <?php
                    printf( '<b class="fn">%1$s</b> %2$s',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ( $comment->user_id === $post->post_author ) ? '<span>' . 楼主 . '</span>' : ''
                    );
                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        /* translators: 1: date, 2: time */
                        sprintf('%1$s', get_comment_date())
                    );
                ?>
            </div><!-- .comment-meta -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation">您的评论正在等待审核</p>
            <?php endif; ?>

            <section class="comment-content">
                <?php comment_text(); ?>
            </section><!-- .comment-content -->
            <div class="reply">
                <?php edit_comment_link( '编辑', '<button class="pure-button pure-button-small pure-button-secondary">', '</button>' ); ?>
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '回复', 'class'=>'here', 'before' => '<button class="pure-button pure-button-xsmall">','after' => '</button>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
    }

    function purity_comment_form(){
        $args = array(
            'id_form'           => 'commentform',
            'class_fomr'        => 'pure-form',
            'id_submit'         => 'submit',
            'title_reply'       => __( 'Leave a Reply' ),
            'title_reply_to'    => __( 'Leave a Reply to %s' ),
            'cancel_reply_link' => __( 'Cancel Reply' ),
            'label_submit'      => __( 'Post Comment' ),

            'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
                '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
                '</textarea></p>',

            'comment_notes_before' => '<p class="comment-notes">' .
                __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
                '</p>',

            'comment_notes_after' => '',

            'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>
                '<p class="comment-form-author">' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="author" class="reply_box" name="author" type="text" placeholder="姓名(必填)" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                '<p class="comment-form-email">' .
                ( $req ? '<span class="required">*</span>' : '' ) .
                '<input id="email" class="reply_box" name="email" type="text" placeholder="邮箱(必填)" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                '<p class="comment-form-url">' .
                '<input id="url" class="reply_box" name="url" type="text" placeholder="主页(选填)" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" /></p>'
            )
            ),

            'label_submit'=>'发表评论',
            'comment_field' => '<p class="comment-form-comment">' . '<textarea id="commentbox" placeholder="好好评论，天天向上" name="comment" rows="8" aria-required="true"></textarea></p>',
        );
        comment_form($args);
    }

    class purity_fixed_ad_Widget extends WP_Widget {

        function purity_fixed_ad_Widget() {
            // Instantiate the parent object
            $widget_ops = array( 'classname' => 'advertisement',
            'description' => '固定广告组件' );
            $this->WP_Widget(false, '固定广告组件', $widget_ops );
        }

        function widget( $args, $instance ) {
            // Widget output
            extract( $args, EXTR_SKIP );
 
            //初始化参数
            $title = empty($instance['title'])?'广告':$instance['title'];
            $content = empty($instance['content'])?'':$instance['content'];
            $content_attr=esc_attr(strip_tags($content));
 
            //输出结构
            ?>
            <li class="my_widget" id="advertisment">
                <h2 class="right_siderbar_subhead"><?=$title?></h2>
                <div style='width:100%;height:180px;background-color:green'><?=$content?></div>
            </li>
            <?php
        }

        function update( $new_instance, $old_instance ) {
            // Save widget options
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['content'] = $new_instance['content'];
            return $instance;
        }

        function form( $instance ) {
        // Output admin widget options form
            $title=isset($instance['title'])?esc_attr($instance['title']):'';
            $title_name=esc_attr($this->get_field_name('title'));
            $content=isset($instance['content'])?esc_attr($instance['content']):'';
            $content_name=esc_attr($this->get_field_name('content'));
 
        ?>
        <p>
            <b>说明</b>
            <br />
            <input style="width:100%" name="<?=$title_name?>" type="text" value="<?=$title?>" />
        </p>
        <p>
            <b>广告内容</b>
            <br />
            <textarea style="width:100%" name="<?=$content_name?>"><?=$content?></textarea>
        </p>
    <?php
        }
    }

    class purity_unfixed_ad_Widget extends WP_Widget {

        function purity_unfixed_ad_Widget() {
            // Instantiate the parent object
            $widget_ops = array( 'classname' => 'advertisement',
            'description' => '滑动广告组件' );
            $this->WP_Widget(false, '滑动广告组件', $widget_ops );
        }

        function widget( $args, $instance ) {
            // Widget output
            extract( $args, EXTR_SKIP );
 
            //初始化参数
            $title = empty($instance['title'])?'广告':$instance['title'];
            $content = empty($instance['content'])?'':$instance['content'];
            $content_attr=esc_attr(strip_tags($content));
 
            //输出结构
            ?>
            <div class="broad">
                <h2 class="right_siderbar_subhead">广而告之</h2>
                <div style='width:100%;height:180px;background-color:black'></div>
            </div>
            <?php
        }

        function update( $new_instance, $old_instance ) {
            // Save widget options
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['content'] = $new_instance['content'];
            return $instance;
        }

        function form( $instance ) {
        // Output admin widget options form
            $title=isset($instance['title'])?esc_attr($instance['title']):'';
            $title_name=esc_attr($this->get_field_name('title'));
            $content=isset($instance['content'])?esc_attr($instance['content']):'';
            $content_name=esc_attr($this->get_field_name('content'));
 
        ?>
        <p>
            <b>说明</b>
            <br />
            <input style="width:100%" name="<?=$title_name?>" type="text" value="<?=$title?>" />
        </p>
        <p>
            <b>广告内容</b>
            <br />
            <textarea style="width:100%" name="<?=$content_name?>"><?=$content?></textarea>
        </p>
    <?php
        }
    }

    class My_Widget_Recent_Comments extends WP_Widget_Recent_Comments {

    /**
     * 构造方法，主要是定义小工具的名称，介绍
     */
    function My_Widget_Recent_Comments() {
        $widget_ops = array('classname' => 'my_widget_recent_comments', 'description' => __('显示最新评论内容'));
        $this->WP_Widget('my-recent-comments', __('评论', 'my'), $widget_ops);
    }

    /**
     * 小工具的渲染方法，这里就是输出评论
     */
    function widget($args, $instance) {
        global $wpdb, $comments, $comment;

        $cache = wp_cache_get('my_widget_recent_comments', 'widget');

        if (!is_array($cache))
            $cache = array();

        if (!isset($args['widget_id']))
            $args['widget_id'] = $this->id;

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        extract($args, EXTR_SKIP);
        $output = '';
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments') : $instance['title'], $instance, $this->id_base);
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 5;
        //获取评论，过滤掉管理员自己
        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE user_id !=2 and comment_approved = '1' and comment_type not in ('pingback','trackback') ORDER BY comment_date_gmt DESC LIMIT $number");
        $output .= $before_widget;
        if ($title)
            $output .= $before_title . $title . $after_title;

        $output .= '<ul id="myrecentcomments">';
        if ($comments) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
            _prime_post_caches($post_ids, strpos(get_option('permalink_structure'), '%category%'), false);

            foreach ((array) $comments as $comment) {
                //头像
                $avatar = get_avatar($comment, 35);
                //作者名称
                $author = get_comment_author();
                //评论内容
                $content = apply_filters('get_comment_text', $comment->comment_content);
                $content = mb_strimwidth(strip_tags($content), 0, '65', '...', 'UTF-8');
                $content = convert_smilies($content);
                //评论的文章
                $post = '<a href="' . esc_url(get_comment_link($comment->comment_ID)) . '">' . get_the_title($comment->comment_post_ID) . '</a>';

                //这里就是输出的html，可以根据需要自行修改
                $output .= '<li class="recent_comment" >
                <div class="recent-comment-avatar" >' . $avatar . '</div>
                <div class="recent-comment-meta" >
                    <p class="comment-author"><span class="fn">' . $author . '</span><span class="says">发表在 ' . $post . '</span></p>
                </div>
                <div class="recent-comment-content"><p class="last">' . $content . '</p></div>
        </li>';
            }
        }
        $output .= '</ul>';
        $output .= $after_widget;

        echo $output;
        $cache[$args['widget_id']] = $output;
        wp_cache_set('my_widget_recent_comments', $cache, 'widget');
    }

}
?>

