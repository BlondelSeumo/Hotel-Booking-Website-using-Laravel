@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center mb-20">{{ SeoHelper::getTitle() }}</h1>
        </div>

        <div class="panel-body">
            <div class="section-content">
                @include('plugins/hotel::booking-info', ['route' => 'customer.generate-invoice'])
            </div>
        </div>
    </div>
@endsection
