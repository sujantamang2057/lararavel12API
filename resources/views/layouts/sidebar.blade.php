<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" target = "_blank" class="brand-link" title = "Preview">
        <span class="brand-text font-weight-light">{{ config('app.name') ?? '' }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
