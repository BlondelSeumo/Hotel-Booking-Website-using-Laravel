<?php

use Botble\Widget\AbstractWidget;

class BlogSocialsWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Blog Socials'),
            'title' => __('Follow Us'),
            'description' => __('Blog socials widget.'),
            'link_1' => 'https://www.facebook.com/',
            'icon_1' => 'fab fa-facebook-f',
            'link_2' => 'https://twitter.com/',
            'icon_2' => 'fab fa-twitter',
            'link_3' => 'https://www.instagram.com/',
            'icon_3' => 'fab fa-instagram',
        ]);
    }
}
