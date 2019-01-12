<!-- checkbox field -->
<style>
    .checkbox label:after {
        display: none;
    }
</style>

<div @include('crud::inc.field_wrapper_attributes') >
    @include('crud::inc.field_translatable_icon')
    <label>
        {{ $field['label'] }}
    </label>
    <div class="checkbox" style="margin-top: 0px">
        @if( isset($field['options']) && $field['options'] = (array)$field['options'] )

            @foreach ($field['options'] as $value => $label )
                <label>
                    <input type="checkbox" value="{{ $value }}"

                           name="{{ $field['name'] }}[]"

                           @if(old($field['name']) ? in_array($value, old($field['name'])) : (isset($field['value']) ? in_array($value, $field['value']) : (isset($field['default']) ? in_array($value, $field['default']) : false )))
                           checked="checked"
                    @endif

                    @if (isset($field['attributes']))
                        @foreach ($field['attributes'] as $attribute => $value)
                            {{ $attribute }}="{{ $value }}"
                        @endforeach
                    @endif
                    > {!! $label !!}
                </label><br/>
            @endforeach
        @endif
        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    </div>
</div>
