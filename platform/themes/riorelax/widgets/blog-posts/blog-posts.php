<?php

use Botble\Widget\AbstractWidget;

class BlogPostsWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Blog Posts'),
            'title' => __('Recent Posts'),
            'description' => __('Blog posts widget.'),
            'type' => 'recent',
            'limit' => 5,
        ]);
    }
}
