<ul class="list-unstyled">
    <li style="margin-bottom: 10px;"><a href="{{ route('kickoff.index') }}" class="btn btn-primary btn-lg">Planview Global Sales Kickoff Site</a></li>
    @if (Entrust::can('view_admin'))
        <li><a href="{{ route('admin.dashboard') }}" class="btn btn-default">Admin Area</a></li>
    @endif
</ul>

<a href="{{ route('auth.changePassword') }}">Change Your Password</a>
