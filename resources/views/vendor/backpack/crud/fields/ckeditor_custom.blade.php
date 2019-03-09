<!-- CKeditor -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <textarea
    	id="ckeditor-{{ $field['name'] }}"
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' => 'form-control'])
    	>{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>
    @endpush

@endif

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
<script>
    // jQuery(document).ready(function($) {
    //     $('#ckeditor-{{ $field['name'] }}').ckeditor({
    //         "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
    //         "extraPlugins" : '{{ isset($field['extra_plugins']) ? implode(',', $field['extra_plugins']) : 'oembed,widget' }}'
    //     });
    // });

        jQuery(document).ready(function($) {
        $('#ckeditor-{{ $field['name'] }}').ckeditor({
            toolbarGroups: [
                // { name: 'links' },
                // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
                // { name: 'links' },
                // { name: 'insert' },
                // { name: 'forms' },
                // { name: 'tools' },
                // { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
                // { name: 'others' },
                // '/',
                { name: 'basicstyles'/*, groups: [ 'basicstyles', 'cleanup' ]*/ },
                { name: 'paragraph',   groups: [ 'list', 'indent' ,/* 'blocks',*/ 'align', 'bidi' ] },
                { name: 'styles' },
                // { name: 'colors' },
                // { name: 'about' }
            ],
            height: 150,
            on: {
                    instanceReady: function( ev ) {
                        console.log(ev)
                        ev.editor.dataProcessor.writer.lineBreakChars     = '',
                        ev.editor.dataProcessor.writer.indentationChars  = ''
                    }
                },
            enterMode:2, //[1=>Enter_p,2=>Enter_br,3=>Enter_div]
        // removeButtons: 'Underline,Subscript,Superscript',
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
            // Se the most common block elements.
            format_tags: 'p;h1;h2;h3;pre',
            // Make dialogs simpler.
            removeDialogTabs: 'image:advanced;link:advanced',

            // AllowedAllContent
            allowedContent: true,
            "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
            "extraPlugins" : '{{ isset($field['extra_plugins']) ? implode(',', $field['extra_plugins']) : 'oembed,widget' }}'
        });   

    });


</script>
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
