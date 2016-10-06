<?php
/**
 * Configuration values
 */
define('GOOGLE_ANALYTICS_ID', LSB_GOOGLE_ANALYTICS_ID); // UA-XXXXX-Y (Note: Universal Analytics only, not Classic Analytics)

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 1140; }
