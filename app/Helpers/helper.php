<?php
function make_slug($string) {
    return preg_replace('/\s+/u', '-', trim($string));
}

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}
function theme_name(){
    $setting = \App\Setting::where('setting', 'theme')->first();
    return '.'.$setting->orgv.'.';
}
function site_name(){
    $setting = \App\Setting::where('setting', 'title')->first();
    return '.'.$setting->orgv.'.';
}
