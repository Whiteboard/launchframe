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

/* :: Ensure URLs have trailing slashes
{+} ---------------------------------- */

/**
 * Ensure a URL has a trailing slash while preserving query parameters and anchors
 * 
 * @param string $url The URL to normalize
 * @return string The URL with a trailing slash added if appropriate
 */
function ensureTrailingSlash($url)
{
    // Return empty string or null as-is
    if (empty($url)) {
        return $url;
    }

    // Skip special protocols
    $special_protocols = ['mailto:', 'tel:', 'javascript:', 'data:', 'file:'];
    foreach ($special_protocols as $protocol) {
        if (stripos($url, $protocol) === 0) {
            return $url;
        }
    }

    // Skip fragment-only URLs (starting with #)
    if (strpos($url, '#') === 0) {
        return $url;
    }

    // Parse the URL
    $parsed = parse_url($url);
    
    // If parsing failed, return original
    if ($parsed === false) {
        return $url;
    }

    // Get the path
    $path = $parsed['path'] ?? '';
    
    // Skip if path is empty
    if (empty($path)) {
        return $url;
    }

    // Skip if path already has a trailing slash
    if (substr($path, -1) === '/') {
        return $url;
    }

    // Skip if path ends with a file extension
    if (preg_match('/\.\w{2,4}$/', $path)) {
        return $url;
    }

    // Add trailing slash to path
    $path .= '/';

    // Reconstruct the URL
    $result = '';
    
    if (isset($parsed['scheme'])) {
        $result .= $parsed['scheme'] . '://';
    }
    
    if (isset($parsed['user'])) {
        $result .= $parsed['user'];
        if (isset($parsed['pass'])) {
            $result .= ':' . $parsed['pass'];
        }
        $result .= '@';
    }
    
    if (isset($parsed['host'])) {
        $result .= $parsed['host'];
    }
    
    if (isset($parsed['port'])) {
        $result .= ':' . $parsed['port'];
    }
    
    $result .= $path;
    
    if (isset($parsed['query'])) {
        $result .= '?' . $parsed['query'];
    }
    
    if (isset($parsed['fragment'])) {
        $result .= '#' . $parsed['fragment'];
    }

    return $result;
}

/**
 * Recursively normalize menu item links to have trailing slashes
 * 
 * @param mixed $menu The menu object or array to normalize
 * @return mixed The normalized menu
 */
function normalizeMenuLinks($menu)
{
    // Handle null or empty menus
    if (empty($menu)) {
        return $menu;
    }
    
    // If it's an object with items property (Timber menu)
    if (is_object($menu) && property_exists($menu, 'items')) {
        foreach ($menu->items as $item) {
            normalizeMenuItem($item);
        }
    }

    return $menu;
}

/**
 * Helper function to normalize a single menu item and its children recursively
 * 
 * @param object $item The menu item to normalize
 */
function normalizeMenuItem($item)
{
    // Normalize this item's URL (Timber menu items use 'url' property)
    if (property_exists($item, 'url')) {
        $item->url = ensureTrailingSlash($item->url);
    }
    
    // Recursively handle nested children
    if (property_exists($item, 'children') && !empty($item->children)) {
        foreach ($item->children as $child) {
            normalizeMenuItem($child);
        }
    }
}