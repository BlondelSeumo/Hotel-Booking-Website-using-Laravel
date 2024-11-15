@extends(BaseHelper::getAdminMasterLayoutTemplate())

@push('header-action')
    <x-core::button
        tag="a"
        :href="route('invoices.generate', ['id' => $invoice->id, 'type' => 'print'])"
        target="_blank"
        icon="ti ti-printer"
    >
        {{ trans('plugins/hotel::invoice.print') }}
    </x-core::button>
    <x-core::button
        tag="a"
        :href="route('invoices.generate', ['id' => $invoice->id, 'type' => 'download'])"
        target="_blank"
        icon="ti ti-download"
    >
        {{ trans('plugins/hotel::invoice.download') }}
    </x-core::button>
@endpush

@section('content')
    <x-core::card size="lg">
        <x-core::card.body>
            <div class="row">
                <div class="col-6 offset-6 text-end">
                    <p class="h3">{{ trans('plugins/hotel::invoice.heading') }}</p>
                    <p class="mb-1">{{ $invoice->customer_name }}</p>
                    <p class="mb-1">{{ $invoice->customer_email }}</p>
                    <p class="mb-1">{{ $invoice->customer_phone }}</p>
                </div>
            </div>

            <div class="my-5">
                <div class="row">
                    <div class="col-lg-3">
                        <strong>{{ trans('plugins/hotel::invoice.code') }}:</strong>
                        #{{ $invoice->code }}
                    </div>
                    <div class="col-lg-3">
                        <strong>{{ trans('plugins/hotel::invoice.status') }}:</strong>
                        {!! $invoice->status->toHtml() !!}
                    </div>
                    <div class="col-lg-3">
                        <strong>{{ trans('plugins/hotel::invoice.purchase_at') }}:</strong>
                        {{ $invoice->created_at->translatedFormat('j F, Y') }}
                    </div>

                    @if ($invoice->payment)
                        <div class="col-lg-3">
                            <strong>{{ trans('plugins/hotel::invoice.payment_method') }}:</strong>
                            {{ $invoice->payment->payment_channel->label() }}
                        </div>
                    @endif
                </div>
            </div>

            <x-core::table class="table-transparent" :striped="false" :hover="false">
                <x-core::table.header>
                    <x-core::table.header.cell>
                        {{ trans('plugins/hotel::invoice.item.name') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell>
                        {{ trans('plugins/hotel::invoice.item.qty') }}
                    </x-core::table.header.cell>
                    <x-core::table.header.cell class="text-center">
                        {{ trans('plugins/hotel::invoice.amount') }}
                    </x-core::table.header.cell>
                </x-core::table.header>

                <x-core::table.body>
                    @foreach ($invoice->items as $item)
                        <x-core::table.body.row>
                            <x-core::table.body.cell>
                                <p class="mb-0">{{ $item->name }}</p>
                                @if ($item->description)
                                    <small>{{ $item->description }}</small>
                                @endif
                            </x-core::table.body.cell>
                            <td>{{ number_format($item->qty) }}</td>
                            <td class="text-center">
                                <strong>{{ format_price($item->sub_total) }}</strong>
                            </td>
                        </x-core::table.body.row>
                    @endforeach

                    <x-core::table.body.row>
                        <x-core::table.body.cell class="text-end" colspan="2">
                            {{ trans('plugins/hotel::invoice.sub_total') }}:
                        </x-core::table.body.cell>
                        <x-core::table.body.cell class="text-center">
                            <strong>{{ format_price($invoice->sub_total) }}</strong>
                        </x-core::table.body.cell>
                    </x-core::table.body.row>
                    @if ($invoice->tax_amount > 0)
                        <x-core::table.body.row>
                            <x-core::table.body.cell class="text-end" colspan="2">
                                {{ trans('plugins/hotel::invoice.tax_amount') }}:
                            </x-core::table.body.cell>
                            <x-core::table.body.cell class="text-center">
                                <strong>{{ format_price($invoice->tax_amount) }}</strong>
                            </x-core::table.body.cell>
                        </x-core::table.body.row>
                    @endif
                    @if ($invoice->discount_amount > 0)
                        <x-core::table.body.row>
                            <x-core::table.body.cell class="text-end" colspan="2">
                                {{ trans('plugins/hotel::invoice.discount_amount') }}:
                            </x-core::table.body.cell>
                            <x-core::table.body.cell class="text-center">
                                <strong>{{ format_price($invoice->discount_amount) }}</strong>
                                <p>({{ $invoice->reference->coupon_code }})</p>
                            </x-core::table.body.cell>
                        </x-core::table.body.row>
                    @endif
                    <x-core::table.body.row>
                        <x-core::table.body.cell class="text-end" colspan="2">
                            {{ trans('plugins/hotel::invoice.total_amount') }}:
                        </x-core::table.body.cell>
                        <x-core::table.body.cell class="text-center">
                            <strong>{{ format_price($invoice->amount) }}</strong>
                        </x-core::table.body.cell>
                    </x-core::table.body.row>
                </x-core::table.body>
            </x-core::table>
        </x-core::card.body>
    </x-core::card>
@stop
