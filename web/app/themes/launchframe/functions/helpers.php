<?php

/**
 * Check if a media array is empty or invalid.
 * 
 * Validates that media has proper structure with asset_type and corresponding data.
 * Used to determine if fallback media should be used instead.
 *
 * @param array|null $media Media array to check
 * @return bool True if media is empty/invalid, false if valid
 */
function is_media_empty($media) {
    if (!$media) {
        return true;
    }
    
    if (!isset($media['asset_type']) || empty($media['asset_type'])) {
        return true;
    }
    
    return !isset($media[$media['asset_type']]) || empty($media[$media['asset_type']]);
}