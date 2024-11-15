<section id="faq" class="faq-area pt-90 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample">
                        @foreach($faqs as $faq)
                            @if($loop->odd)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $loop->index }}">
                                        <h2 class="mb-0">
                                            <button title="{!! BaseHelper::clean($faq->question) !!}" class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                                {!! BaseHelper::clean($faq->question) !!}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="{{ "collapse$loop->index" }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample" style="">
                                        <div class="card-body">
                                            {!! BaseHelper::clean($faq->answer) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample1">
                        @foreach($faqs as $faq)
                            @if($loop->even)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $loop->index }}">
                                        <h2 class="mb-0">
                                            <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}">
                                                {!! BaseHelper::clean($faq->question) !!}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="{{ "collapse$loop->index" }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample1" style="">
                                        <div class="card-body">
                                            {!! BaseHelper::clean($faq->answer) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
