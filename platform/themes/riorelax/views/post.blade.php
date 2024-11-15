@php
    Theme::set('pageTitle', $post->name);
@endphp
<section class="inner-blog b-details-p pt-80 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-wrap">
                    <div class="details__content pb-30">
                        <h2>{{ $post->name }}</h2>
                        <div class="meta-info">
                            <ul>
                                <li><i class="fal fa-eye"></i>{{ number_format($post->views) }}</li>
                                <li><i class="fal fa-calendar-alt"></i>{{ $post->created_at->translatedFormat('M d, Y') }}</li>
                            </ul>
                        </div>
                        <div class="ck-content">
                            {!! BaseHelper::clean($post->content) !!}
                        </div>
                        @if ($post->tags->isNotEmpty())
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="post__tag">
                                        <h5>{{ __('Related Tags') }}</h5>
                                        <ul>
                                            @foreach($post->tags as $tag)
                                                <li>
                                                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(($posts = get_related_posts($post->id, 2)) && $posts->isNotEmpty())
                        <div class="posts_navigation pt-35 pb-100">
                            <div class="row align-items-center">
                                @if($prevPost = $posts[0])
                                    <div class="col-xl-4 col-md-5">
                                        <div class="prev-link">
                                            <span>{{ __('Prev Post') }}</span>
                                            <h4><a href="{{ $prevPost->url }}">{{ $prevPost->name }}</a></h4>
                                        </div>
                                    </div>
                                @endif
                                @if ($post->firstCategory)
                                    <div class="col-xl-4 col-md-2 text-md-center">
                                        <a href="{{ $post->firstCategory->url }}" class="blog-filter"><img src="{{ Theme::asset()->url('images/blog-category-icon.png') }}" alt="{{ $post->firstCategory->name }}" /></a>
                                    </div>
                                @endif
                                @if($nextPost = (isset($posts[1]) ? $posts[1] : null))
                                    <div class="col-xl-4 col-md-5">
                                        <div class="next-link text-end text-md-right">
                                            <span>{{ __('Next Post') }}</span>
                                            <h4><a href="{{ $nextPost->url }}">{{ $nextPost->name }}</a></h4>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="mb-60"></div>
                    @endif

                    @php($author = $post->author)
                    <div class="avatar__wrap text-center mb-45">
                        <div class="avatar-img">
                            <img class="author-blog-avatar" src="{{ $author->avatar_url }}" alt="{{ $author->getMetaData('display_name', true) ?: $author->name }}" />
                        </div>
                        <div class="avatar__info">
                            <h5>{{ $author->getMetaData('display_name', true) ?: $author->name }}</h5>
                            <div class="avatar__info-social">
                                @foreach(['facebook', 'twitter', 'instagram', 'behance', 'linkedin'] as $social)
                                    @if ($url = $author->getMetaData($social, true))
                                        @switch($social)
                                            @case('twitter')
                                                <a href="{{ $url }}"><i class="fab fa-twitter"></i></a>
                                                @break

                                            @case('facebook')
                                                <a href="{{ $url }}"><i class="fab fa-facebook-f"></i></a>
                                                @break

                                            @case('instagram')
                                                <a href="{{ $url }}"><i class="fab fa-instagram"></i></a>
                                                @break

                                            @case('behance')
                                                <a href="{{ $url }}"><i class="fab fa-behance"></i></a>
                                                @break

                                            @case('linkedin')
                                                <a href="{{ $url }}"><i class="fab fa-linkedin"></i></a>
                                                @break
                                        @endswitch
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="avatar__wrap-content">
                            {!! BaseHelper::clean($author->getMetaData('bio', true)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <aside class="sidebar-widget">
                    {!! dynamic_sidebar('blog_sidebar') !!}
                </aside>
            </div>
        </div>
    </div>
</section>
