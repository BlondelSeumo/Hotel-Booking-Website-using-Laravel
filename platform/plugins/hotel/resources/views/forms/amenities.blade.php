@foreach ($amenities as $amenity)
    <x-core::form.checkbox
        :label="$amenity->name"
        name="amenities[]"
        :value="$amenity->id"
        :checked="in_array($amenity->id, $selectedAmenities)"
        inline
    />
@endforeach
