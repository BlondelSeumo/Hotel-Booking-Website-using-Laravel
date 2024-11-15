@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::form :url="route('coupons.create')" method="post" class="coupon-form">
        @include('plugins/hotel::coupons.partials.coupon-form')
    </x-core::form>
@endsection
