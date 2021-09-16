<?php

function getCurrentAdmin()
{
    if (auth()->guard('admins')->check()) {
        return auth()->guard('admins')->user();
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd M, Y h:i A'): ?string
    {
        if ($date != null) {
            return Carbon\Carbon::parse($date)->format($format);
        }
        return null;
    }
}

function formatPrice($price = 0): string
{
    return "₹ " . number_format(($price ? floatval($price) : 0), 2, ".", ",");
}

function showBlogImage($image_name)
{
    return url(\App\Models\Blog::IMG_URL . $image_name);
}

function showUserImage($image_name)
{
    return url(\App\Models\User::IMG_URL . $image_name);
}


