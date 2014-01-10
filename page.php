<?php get_header(); ?>
<div class="pure-u-1">
        
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
                <h1 class="content-subhead">Page</h1>
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
                        </p>
                    </header>
                    <div class="post-description">
                        <?php the_content('Read the rest of this entry &raquo;'); ?>
                    </div>
                </section>

            	<?php endwhile; ?>
            </div>
			<?php else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn'there.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?> 
			<?php endif; ?>
			<?php comments_template(); ?>
        </div>
        <?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.1.min.js"></script>
<script>
        $(document).ready(function() {
            // Show or hide the sticky footer button
             $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    var str = $('.right_sidebar').height();
                    if ($(this).scrollTop() > str) {
                        $('#go-top').fadeIn(200);
                    };
                } else {
                    $('#go-top').fadeOut(200);
                }
            });

            $(window).scroll(function() {
                if ($(this).scrollTop() > 600) {
                    var str = $('.right_sidebar').height();
                    if ($(this).scrollTop() > str) {
                        $('.broad').fadeIn(200);
                    };
                } else {
                    $('.broad').fadeOut(200);     
                }
            });
            
            // Animate the scroll to top
            $('#go-top').click(function(event) {
                event.preventDefault();
                
                $('html, body').animate({scrollTop: 0}, 300);
            })
        });
    </script>
</body>
</html>