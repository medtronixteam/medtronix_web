<?php
if (!function_exists('asset_versioned')) {
    function asset_versioned($path)
    {
        $filePath = public_path($path);

        if (file_exists($filePath)) {
            $timestamp = filemtime($filePath);
            return asset($path) . '?v=' . $timestamp;
        }

        return asset($path);
    }
}
