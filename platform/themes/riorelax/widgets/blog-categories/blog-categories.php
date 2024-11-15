<?php

use Botble\Widget\AbstractWidget;

class BlogCategoriesWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Blog Categories'),
            'title' => __('Categories'),
            'description' => __('Blog categories widget.'),
            'number_display' => 5,
        ]);
    }
}
