<?php
/*
Template Name: Links
*/
?>
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
                <h1 class="content-subhead">友情链接</h1>
                <!-- A gallery page -->
                <div id="gallerydisplay">
                <?php 
                the_post();
                the_content();
                ?>
                </div>
				<?php comments_template(); ?>
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