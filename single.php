<?php get_header(); ?>
<div class="pure-u-1">
        <div class="content">
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <div class="pure-g-r" id='social'>
                    <div class="pure-u-1-5">
                        <a href='http://renren.com'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-facebook-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='http://renren.com'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-twitter-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='http://renren.com'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-github-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='http://renren.com'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-googleplus-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='http://renren.com'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-rss-outline.svg'></img></a>
                    </div>
                </div>
                <h1 class="content-subhead">Post</h1>
                <!-- A single blog post -->
                <?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
                <section class="post" id="post-<?php the_ID(); ?>">
                    <header class="post-header">
                    	<div class="post-avatar">
                    		<?php echo get_avatar( get_the_author_email(), 47); ?>
                    	</div>

                        <h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                        <p class="post-meta">
                            作者 <a class="post-author"><?php the_author() ?></a> 分类 
                            <?php
                            $keywords = "";
                            $tags = get_the_category();
                            foreach ($tags as $tag ) {
                            $keywords .= "<a class='post-category post-category-design' >".$tag->name."</a>";
                            }   
                            echo $keywords;   
                            ?>
                        </p>
                    </header>

                    <div class="post-description">
                        <?php the_content('Read the rest of this entry &raquo;'); ?>
                    </div>
                </section>
            	<?php endwhile; ?>
            </div>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; OlderEntries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries&raquo;') ?></div>
			</div>
			<?php else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn'there.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?> 
			<?php endif; ?>
			<?php comments_template(); ?>
        </div>
        <?php get_footer(); ?>
        <div id="content1">
        <a href="#modal" class="second">菜单</a>
        </div>
        <div id="modal">
            <?php get_sidebar(); ?>
        </div>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.1.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.pageslide.min.js"></script>
<script>
        /* Slide to the left, and make it model (you'll have to call $.pageslide.close() to close) */
        $(".second").pageslide({ direction: "left", modal: true });
        $(".second").click(function(){
            var ui = document.getElementById("sidebar-pure-u");
            if(ui.style.display == "none"){
                ui.style.display = "";
                $.pageslide.close();
            }else{
                ui.style.display="none";
            }
        });
        $(".pure-u-1").click(function(){
            var ui = document.getElementById("sidebar-pure-u");
            if(ui.style.display == "none"){
                ui.style.display = "";
                $.pageslide.close();
            }
        });
    </script>
</body>
</html>