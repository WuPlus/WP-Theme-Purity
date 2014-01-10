<?php
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
            $instance['content'] = strip_tags($new_instance['content']);
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
            $instance['content'] = strip_tags($new_instance['content']);
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