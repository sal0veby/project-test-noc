@php
    $value = data_get($entry, $column['name']);

    if (is_array($value)) {
        $value = json_encode($value);
    }
@endphp

<input
    type="text"
    value="{{ $value }}"
    class="form-control input-sm"
    onchange="updateEntry(this)"
    data-url="{{ url($crud->route) }}/{{ $entry->getKey() }}/{{ $column['name'] }}"
/>

<script>
    if (typeof updateEntry !== 'function') {
        function updateEntry(entry) {
            var input = $(entry);
            var route = input.attr('data-url');

            $.ajax({
                url: route,
                type: 'patch',
                data: {"{{ $column['name'] }}": input.val()},
                start: $('input').attr('readonly', 'readonly'),
                success: function (result) {
                    // Show an alert with the result
                    new PNotify({
                        text: "{{ trans('backpack::crud.update_success') }}",
                        type: "success"
                    });

                    crud.table.draw();
                    $('input').removeAttr('readonly');
                },
                error: function (result) {
                    // Show an alert with the result
                    for (var index in result.responseJSON.errors) {
                        var error = result.responseJSON.errors[index];
                        for (var message of error) {
                            new PNotify({
                                text: message,
                                type: "error"
                            })
                        }
                    }

                    input.focus();
                    $('input').removeAttr('readonly');
                }
            });
        }
    }
</script>
