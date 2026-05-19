@props(['name', 'placeholder'])

<select placeholder="{{ $placeholder }}" name="{{ $name }}" id="{{ $name }}" required></select>
<script>
    new TomSelect("#{{ $name }}", {
        copyClassesToDropdown: true,
        maxItems: 1,
        plugins: ["dropdown_input"],
        valueField: "coordinates",
        labelField: "display_name",
        searchField: "display_name",
        load: async (query, callback) => {
            const res = await fetch(
                `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&accept-language=pt-br&countrycodes=br&format=json`,
            );
            const data = await res.json();
            for (const item of data) {
                item.coordinates = `${ item.lon },${ item.lat}`;
            }
            callback(data);
        },
    })
</script>
