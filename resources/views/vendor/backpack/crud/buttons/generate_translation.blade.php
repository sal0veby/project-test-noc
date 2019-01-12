<a class="btn btn-success ladda-button" id="generate_file"
   href="{{ url(config('backpack.base.route_prefix', 'admin') . getSiteSlug() .'/dictionary/generate') }}"
   data-style="zoom-in">
 <span class="ladda-label">
        <i class="fa fa-file-text-o" style="margin-right: 3px;"></i>
     {{ __('Generate dictionary') }}
    </span>
</a>


