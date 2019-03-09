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
            $classed_id = !empty($crud->entry->classes_id) ? $crud->entry->classes_id : old('classes_id');
            $location_id = !empty($crud->entry->location_id) ? $crud->entry->location_id : old('location_id');
            $work_type = \App\Models\WorkType::where(['classes_id' => $classed_id, 'location_id' => $location_id])->get();
            ?>

            @foreach($work_type as $value)
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
            var dataModelJson = '<?php echo json_encode($field['model']::all()->toArray()) ?>';
            var current_value = '<?php echo $current_value ?>';


            $("select[name='{{ $field['name_relation'] }}']").on('change', () => {
                getDataTwoConditionSelected();
            });


            function getDataTwoConditionSelected() {
                if (dataModelJson != '') {
                    $("select[name='{{ $field['name'] }}']").empty();

                    var dataDecode = JSON.parse(dataModelJson);
                    var selected_id = $("select[name='classes_id']").val();
                    var selected_id2 = $("select[name='{{ $field['name_relation'] }}']").val();

                    $("select[name='{{ $field['name'] }}']").append('<option value="">{{ __('Please select') }}</option>');

                    $.each(dataDecode, function ($key, $val) {
                        if ($val['classes_id'] == selected_id) {
                            if ($val['{{ $field['name_relation'] }}'] == selected_id2) {
                                if (current_value == $val['id']) {
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
                        }
                    });

                    @if(isset($field['description']) && $field['description'] == true)
                    $("select[name='{{ $field['name'] }}']").append('<option value="99">{{ __('Other') }}</option>');
                    @endif

                }
            }

            {{--@if($current_value != '')--}}
            {{--$("select[name='{{ $field['name2'] }}']").trigger('change');--}}

            {{--@if(isset($field['name3']))--}}
            {{--$("select[name='{{ $field['name3'] }}']").trigger('change');--}}
            {{--@endif--}}


        </script>
    @endpush


</div>
