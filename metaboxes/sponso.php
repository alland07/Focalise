<?php
class SponsoMetaBox {

    const META_KEY = 'montheme_sponso';
    const NONCE = '_montheme_sponso_nonce';

    public static function register () {
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add($postType, $post) 
    {
        if ($postType === 'post' && current_user_can('publish_posts', $post)) {
            add_meta_box(self::META_KEY,'Sponsoring', [self::class, 'render'], 'post', 'side');
        }
        
    }

    public static function render ($post) {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE, self::NONCE);
        ?>
        <input type="hidden" value="0" name="<?= self::META_KEY ?>">
        <input type="checkbox" value="1" name="<?= self::META_KEY ?>" <?php checked($value, '1') ?>>
        <label for="monthemesponso">Cet article est sponsorisé ?</label>
    
        <?php
    }

    public static function save ($post) {
    
    if (
        array_key_exists(self::META_KEY, $_POST) && 
        current_user_can('publish_posts', $post) && 
        wp_verify_nonce($_POST[self::NONCE], self::NONCE)
        ) {
        if ($_POST[self::META_KEY] === '0'){
            delete_post_meta($post, self::META_KEY);
        } else {
            update_post_meta($post, self::META_KEY, 1);
        }
    }
    }
}