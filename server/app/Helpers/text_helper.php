<?php

if (!function_exists('truncate_words')) {
    function truncate_words($text, $limit = 20) {
        $words = explode(' ', $text);
        if (count($words) > $limit) {
            return implode(' ', array_slice($words, 0, $limit)) . '...';
        }
        return $text;
    }
}
