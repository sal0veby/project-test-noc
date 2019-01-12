<!-- text input -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix']))
        <div class="input-group"> @endif
            @if(isset($field['prefix']))
                <div class="input-group-addon">{!! $field['prefix'] !!}</div> @endif
            <input
                type="text"
                name="{{ $field['name'] }}"
                value="{{ old($field['name']) ?? $field['value'] ?? $field['default'] ?? '' }}"
                {{ old($field['name']) ? '' : 'disabled="disabled"' }}
                @include('crud::inc.field_attributes')
            >
            @if(isset($field['suffix']))
                <div class="input-group-addon">{!! $field['suffix'] !!}</div> @endif
            @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

    @push('crud_fields_scripts')
        <script>
            $("select[name='{{ $field['select_name'] }}']").on('change', () => {
                if ($("select[name='{{ $field['select_name'] }}']").val() == 99) {
                    $("input[name='{{ $field['name'] }}']").removeAttr("disabled")
                } else {
                    $("input[name='{{ $field['name'] }}']").attr("disabled", 'disabled');
                }
            });
        </script>
    @endpush
</div>

