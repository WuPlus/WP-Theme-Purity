<div class ="right_sidebar" >
    <div class="pure-g-r" id='social-2'>
        <form class="pure-form">
        <input type="text" class="pure-input-rounded" placeholder="搜索">
        </form>      
    </div>
    
    <?php if ( !is_user_logged_in() ) {
        echo "<a id='leftbutton' class='pure-button' href='".wp_login_url($redirect)."'>登录</a>";
        echo "<a id='rightbutton' class='pure-button' href='".wp_registration_url()."'>注册</a>";
    } else {
        # code...
        echo "<a id='leftbutton' class='pure-button' href='".wp_logout_url($redirect)."'>登出</a>";
        echo "<a id='rightbutton' class='pure-button' href='".admin_url()."'>管理</a>";
    } ?>
    <?php if(is_dynamic_sidebar()) 
        dynamic_sidebar();
    ?>
</div>  