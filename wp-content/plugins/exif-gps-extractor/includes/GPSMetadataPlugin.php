<?php

class GPSMetadataPlugin {
    private static $instance = null;

    private function __construct() {
        add_filter('wp_generate_attachment_metadata', [$this, 'save_gps_metadata'], 10, 2);
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function save_gps_metadata($metadata, $attachment_id) {
        $file = $this->get_original_file($attachment_id, $metadata);
        $gps_data = GPSMetadataExtractor::extract($file);

        if ($gps_data) {
            $metadata['image_meta']['lat'] = $gps_data['lat'];
            $metadata['image_meta']['lon'] = $gps_data['lon'];
        }

        return $metadata;
    }

    private function get_original_file($attachment_id, $metadata) {
        $file = get_attached_file($attachment_id);

        if (isset($metadata['original_image'])) {
            $upload_dir = wp_upload_dir();
            $original_file = $upload_dir['path'] . '/' . $metadata['original_image'];

            if (file_exists($original_file)) {
                $file = $original_file;
            }
        }

        return $file;
    }
}
?>
