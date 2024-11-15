<calendar-modal-component
    get-room-availability-url="{{ route('room.availability', $object->id) }}"
    v-slot="{ form, saveForm }"
>
    <div id="dates-calendar" class="dates-calendar"></div>

    <x-core::modal id="modal-calendar">
        <div class="mb-3">
            <x-core::form.checkbox
                :label="__('plugins/hotel::room.form.is_available')"
                true-value="1"
                false-value="0"
                v-model="form.active"
            />
        </div>

        <div v-show="form.active">
            <x-core::form.text-input
                type="number"
                name="room_availability_value"
                :label="__('plugins/hotel::room.form.value')"
                v-model="form.value"
            />

            <x-core::form.select
                v-show="form.active"
                name="room_availability_value_type"
                v-model="form.value_type"
            >
                <option :selected="form.value_type === 'fixed'" value="fixed">
                    {{ __('plugins/hotel::room.form.fixed') }}
                </option>
                <option
                    :selected="form.value_type === 'amount_adjust'"
                    value="amount_adjust"
                >
                    {{ __('plugins/hotel::room.form.amount_adjust') }}
                </option>
                <option
                    :selected="form.value_type === 'percentage_adjust'"
                    value="percentage_adjust"
                >
                    {{ __('plugins/hotel::room.form.percentage_adjust') }}
                </option>
            </x-core::form.select>

            <x-core::alert type="info" v-if="form.value_type === 'percentage_adjust'">
                {{ __('Adjust the value within a range of -100% to unlimited !') }}
            </x-core::alert>

            <x-core::form.text-input
                :label="__('plugins/hotel::room.form.number_of_rooms')"
                type="number"
                name="room_availability_number_of_rooms"
                v-model="form.number_of_rooms"
            />
        </div>

        <x-slot:footer>
            <x-core::button data-bs-dismiss="modal">
                {{ __('plugins/hotel::room.form.close') }}
            </x-core::button>
            <x-core::button color="primary" @click="saveForm">
                {{ __('plugins/hotel::room.form.save_changes') }}
            </x-core::button>
        </x-slot:footer>
    </x-core::modal>
</calendar-modal-component>
