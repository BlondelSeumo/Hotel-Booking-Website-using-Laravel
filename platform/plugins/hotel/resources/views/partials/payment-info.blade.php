<div class="my-3">
    <x-core::datagrid>
        <x-core::datagrid.item :title="trans('plugins/payment::payment.payer_name')">
            {{ $booking->address->full_name }}
        </x-core::datagrid.item>
        <x-core::datagrid.item :title="trans('plugins/payment::payment.email')">
            {{ $booking->address->email }}
        </x-core::datagrid.item>
        <x-core::datagrid.item :title="trans('plugins/payment::payment.phone')">
            {{ $booking->address->phone }}
        </x-core::datagrid.item>
    </x-core::datagrid>
</div>
