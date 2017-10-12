<div class="list-group" style="margin-top: 65px;">
    <a class="list-group-item {{ Request::is('admin') ? ' active' : '' }}" href="{{ url('admin') }}">
        <i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Dashboard
    </a>
    <a class="list-group-item {{ Request::is('admin/users') ? ' active' : '' }}" href="{{ url('admin/users') }}">
        <i class="fa fa-user fa-fw" aria-hidden="true"></i>&nbsp; Users
    </a>

</div>

