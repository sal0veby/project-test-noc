@if($entry->is_sync)
    <a class="btn btn-success btn-xs"
       href="{{ route('generate_api' , ['service' => $entry->service])}}"
       data-style="zoom-in">
 <span class="ladda-label">
        <i class="fa fa-file-text-o" style="margin-right: 3px;"></i>
     {{ __('Generate') }}
    </span>
    </a>
@endif


