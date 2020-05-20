<?php 

class YoutubeWidget extends WP_Widget {
    public function __construct()
    {
        parent::__construct('youtube_widget', 'Youtube Widget');
    }

    public function widget($args, $instance){
        echo $args['before_widget'];
        if(isset($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : ';';
        echo '<iframe width="400" height="200" src="https://www.youtube.com/embed/'. esc_attr($youtube) . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo $args['after_widget'];
    }

    public function form ($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';
        ?>
            <p>
                <label for="<?= $this->get_field_id('title') ?>">Titre</label>
                <input 
                class="widefat" 
                type="text" 
                name="<?= $this->get_field_name('title') ?>" 
                value="<?= esc_attr($title) ?>"
                id="<?= $this->get_field_name('title') ?>">
            </p>
            <p>
                <label for="<?= $this->get_field_id('youtube') ?>">Id youtube</label>
                <input 
                class="widefat" 
                type="text" 
                name="<?= $this->get_field_name('youtube') ?>" 
                value="<?= esc_attr($youtube) ?>"
                id="<?= $this->get_field_name('youtube') ?>">
            </p>
        <?php
    }

    public function update($newInstance, $oldInstance) {

        return $newInstance;
    }
}