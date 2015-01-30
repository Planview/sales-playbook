<ul class="list-unstyled lead">
    <li><a href="{{ route('kickoff.index') }}">Sales Kickoff Microsite</a></li>
    @if (Entrust::can('view_admin'))
        <li><a href="{{ route('admin.dashboard') }}">Admin Area</a></li>
    @endif
</ul>

<a href="{{ route('auth.changePassword') }}" class="label label-default">Change Your Password</a>