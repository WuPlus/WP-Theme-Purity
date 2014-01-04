<?php
    register_nav_menus();

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
?>

