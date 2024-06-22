<?php

class GPSMetadataExtractor {
    public static function extract($file) {
        if (file_exists($file)) {
            $exif = @exif_read_data($file, 'EXIF', true);

            if ($exif && isset($exif['GPS'])) {
                $lat = self::gps2num($exif['GPS']['GPSLatitude'], $exif['GPS']['GPSLatitudeRef']);
                $lon = self::gps2num($exif['GPS']['GPSLongitude'], $exif['GPS']['GPSLongitudeRef']);

                return ['lat' => $lat, 'lon' => $lon];
            }
        }

        return false;
    }

    private static function gps2num($coordPart, $hemisphere) {
        $degrees = isset($coordPart[0]) ? self::gps2Float($coordPart[0]) : 0;
        $minutes = isset($coordPart[1]) ? self::gps2Float($coordPart[1]) : 0;
        $seconds = isset($coordPart[2]) ? self::gps2Float($coordPart[2]) : 0;

        $flip = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;

        return $flip * ($degrees + ($minutes / 60) + ($seconds / 3600));
    }

    private static function gps2Float($part) {
        $parts = explode('/', $part);

        if (count($parts) <= 0) {
            return 0;
        }

        if (count($parts) == 1) {
            return (float) $parts[0];
        }

        return (float) $parts[0] / (float) $parts[1];
    }
}
?>
