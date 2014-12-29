@if (Session::has('message'))
    {{ Alert::info(Session::get('message'))->close()->fixed() }}
@elseif (Session::has('error'))
    {{ Alert::danger(Session::get('error'))->close()->fixed() }}
@endif
