<!-- select -->
@php
    $current_value = old($field['name']) ?? $field['value'] ?? $field['default'] ?? '';
@endphp

<div @include('crud::inc.field_wrapper_attributes') >

    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <?php $entity_model = $crud->getRelationModel($field['entity'], -1); ?>

    <select
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes')
    >
        <option value="">{{ __('Please select') }}</option>

        @if(!empty($current_value))
            <?php
            $classes_id = !empty($crud->entry->classes_id) ? $crud->entry->classes_id : old('classes_id');
            $location = \App\Models\Location::where('classes_id', $classes_id)->get();
            ?>

            @foreach($location as $value)
                @if($current_value == array_get($value , 'id'))
                    <option value="{{ array_get($value , 'id') }}" selected>{{ array_get($value , 'name') }}</option>
                @else
                    <option value="{{ array_get($value , 'id') }}">{{ array_get($value , 'name') }}</option>
                @endif
            @endforeach
            <option value="99">{{ __('Other') }}</option>
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

    @push('crud_fields_scripts')
        <script>
            var dataModelJson1 = '<?php echo json_encode($field['model']::all()->toArray()) ?>';
            var current_value1 = '<?php echo $current_value ?>';

            $("select[name='{{ $field['name_relation'] }}']").on('change', () => {
                getDataOneConditionSelected();
            });

            function getDataOneConditionSelected() {
                if (dataModelJson1 != '') {
                    $("select[name='{{ $field['name'] }}']").empty();

                    var dataDecode = JSON.parse(dataModelJson1);
                    var selected_id = $("select[name='{{ $field['name_relation'] }}']").val();

                    $("select[name='location_id']").append('<option value="">{{ __('Please select') }}</option>');

                    $.each(dataDecode, function ($key, $val) {
                        if ($val['{{ $field['name_relation'] }}'] == selected_id) {
                            if (current_value1 == $val['id']) {
                                var option = $("<option/>").attr({
                                    "value": $val['id'],
                                    'selected': 'selected'
                                }).text($val['name']);
                                $("select[name='{{ $field['name'] }}']").append(option);
                            } else {
                                var option = $("<option/>").attr({
                                    "value": $val['id']
                                }).text($val['name']);
                                $("select[name='{{ $field['name'] }}']").append(option);
                            }
                        }
                    });

                    @if(isset($field['description']) && $field['description'] == true)
                    $("select[name='{{ $field['name'] }}']").append('<option value="99">{{ __('Other') }}</option>');
                    @endif
                }
            }

        </script>
    @endpush


</div>
