@php
    Theme::set('pageTitle', $page->name);
    Theme::set('pageDescription', $page->description);
    Theme::set('breadcrumbBackgroundImage', $page->getMetaData('breadcrumb_background', true));
    Theme::set('breadcrumb', $page->getMetaData('breadcrumb', true))
@endphp

{!!
    apply_filters(
        PAGE_FILTER_FRONT_PAGE_CONTENT,
        Html::tag('div', BaseHelper::clean($page->content), ['class' => 'ck-content'])->toHtml(),
        $page
    )
!!}
