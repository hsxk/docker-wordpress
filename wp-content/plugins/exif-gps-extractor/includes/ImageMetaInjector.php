<?php

class ImageMetaInjector {
    private static $instance = null;

    private function __construct() {
        add_filter('wp_get_attachment_image_attributes', [$this, 'add_image_meta_to_data'], 10, 3);
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add_image_meta_to_data($attr, $attachment) {
        $meta = wp_get_attachment_metadata($attachment->ID);
        if (isset($meta['image_meta'])) {
            foreach ($meta['image_meta'] as $key => $value) {
                if (!empty($value)) {
                    // Convert arrays to JSON strings
                    $attr['data-' . $key] = is_array($value) ? json_encode($value) : $value;
                }
            }
        }
        return $attr;
    }
    
}
?>