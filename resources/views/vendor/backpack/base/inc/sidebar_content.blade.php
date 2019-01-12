<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li>
    <a href="{{ backpack_url('dashboard') }}">
        <i class="fa fa-dashboard"></i>
        <span>{{ __('Dashboard') }}</span>
    </a>
</li>

<li class="header">
    <h5>{{ __('Component') }}</h5>
</li>

<li>
    <a href="{{ backpack_url('job') }}">
        <i class="fa fa-file-o"></i>
        <span>{{ __('Job list') }}</span>
    </a>
</li>

<li class="header">
    <h5>{{ __('Report') }}</h5>
</li>

<li>
    <a href="#">
        <i class="fa fa-file-text"></i>
        <span>{{ __('Job Report') }}</span>
    </a>
</li>

<li>
    <a href="#">
        <i class="fa fa-file-text"></i>
        <span>{{ __('Hot work Report') }}</span>
    </a>
</li>

<li class="header">
    <h5>{{ __('Management') }}</h5>
</li>

<li>
    <a href="{{ backpack_url('class') }}">
        <i class="fa fa-list"></i>
        <span>{{ __('Class') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('location') }}">
        <i class="fa fa-location-arrow"></i>
        <span>{{ __('Location') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('work_type') }}">
        <i class="fa fa-dot-circle-o"></i>
        <span>{{ __('Work type') }}</span>
    </a>
</li>

<!-- Users, Roles Permissions -->
<li class="header">
    <h5>{{ __('Management User') }}</h5>
</li>

<li>
    <a href="{{ backpack_url('user') }}">
        <i class="fa fa-user"></i>
        <span>{{ __('User') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('role') }}">
        <i class="fa fa-group"></i>
        <span>{{ __('Role') }}</span>
    </a>
</li>

<li>
    <a href="{{ backpack_url('permission') }}">
        <i class="fa fa-key"></i>
        <span>{{ __('Permission') }}</span>
    </a>
</li>

<!-- Setting User -->
<li class="header">
    <h5>{{ __('Setting') }}</h5>
</li>

<li>
    <a href="{{ route('backpack.account.info') }}">
        <i class="fa fa-gears"></i>
        <span>{{ __('Setting') }}</span>
    </a>
</li>

