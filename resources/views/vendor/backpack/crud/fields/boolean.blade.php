<!-- select from array -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <select
            name="{{ $field['name'] }}@if (isset($field['allows_multiple']) && $field['allows_multiple']==true)[]@endif"
            @include('crud::inc.field_attributes')
            @if (isset($field['allows_multiple']) && $field['allows_multiple']==true)multiple @endif
    >

        @if (isset($field['allows_null']) && $field['allows_null']==true)
            <option value="">-</option>
        @endif
        @if (count($field['options']))
            @foreach ($field['options'] as $key => $value)
                @if(isset($field['value']))
                        <option value="{{ $key }}" {!! $key == $field['value'] ? 'selected' : '' !!}>{{ $value }}</option>
                @else
                        <option value="{!! $key !!}">{!! $value !!}</option>
                @endif
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
