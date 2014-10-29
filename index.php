<?php get_header(); ?>
<div class="pure-u-1">
        <div class="pure-g-r" id='social'>
                    <div class="pure-u-1-5">
                        <a href='http://renren.com'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-facebook-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='http://weibo.com/wuplus1992'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-twitter-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='https://github.com/WuPlus'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-github-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='#'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-googleplus-outline.svg'></img></a>
                    </div>
                    <div class="pure-u-1-5">
                        <a href='#'><img src='<?php echo get_template_directory_uri(); ?>/icon/social-rss-outline.svg'></img></a>
                    </div>
            </div>
            <h1 class="content-subhead">Recent Post</h1>
        <div class="content">
            <!-- A wrapper for all the blog posts -->
            <div style="clear:both"></div>
            <?php get_sidebar();?>
            <div class="posts">
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
                            作者 <a class="post-author"><?php the_author() ?></a> 
                            <?php
                            get_post_meta_info(get_the_ID());
                            ?>
                        </p>
                    </header>

                    <div class="post-description">
                        <?php if ( has_post_thumbnail() ) { ?>
                                <?php the_post_thumbnail('thumbnail',array('class'=>'thumb')); ?>
                        <?php } else {?>
                        <img src="<?php bloginfo('template_url'); ?>/icon/<?php echo rand(1,6)?>.jpg" class="thumb" />
                        <?php } ?>
                        <?php the_content('已经有'.getPostViews(get_the_ID()).'人阅读了余下的内容，点击阅读 &raquo;'); ?>
                    </div>
                </section>
            	<?php endwhile; ?>
                <?php pagination($query_string); ?>
            </div>
			<?php else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn'there.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?> 
			<?php endif; ?>
        </div>
        <?php get_footer();?>
    </div>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.1.min.js"></script>
</body>
</html>