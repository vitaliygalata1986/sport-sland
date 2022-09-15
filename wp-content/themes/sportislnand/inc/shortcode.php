<?php

add_shortcode('si-paste-link', 'si_paste_link');
function si_paste_link($attr)
{
    $params = shortcode_atts([
        'link' => '',
        'text' => '',
        'type' => 'link',
    ], $attr); // [] массив значений по умочанию
    $params['text'] = $params['text'] ? $params['text'] : $params['link'];
    if ($params['link']) { // если link передан, то мы что-то делаем
        $protocol = '';
        switch ($params['type']) {
            case 'email':
                $protocol = 'mailto:';
                break;
            case 'phone':
                $protocol = 'tel:';
                $params['link'] = preg_replace('/[^+0-9]/', '', $params['link']);
                break;
            default:
                $protocol = '';
                break;
        }
        $link = $protocol . $params['link'];
        $text = $params['text'];
        return "<a href=\"${link}\">${text}</a>";
    } else {
        return '';
    }
}
