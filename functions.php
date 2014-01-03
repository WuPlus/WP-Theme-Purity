<?php
    register_nav_menus();
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
?>