<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow no-print">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">سامانه مدیریت صندوق</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="جستجو" aria-label="Search">
    <ul class="navbar-nav col-md-2">
        <li class="nav-item active text-left mr-2">
            <a class="nav-link d-inline" href="#" role="button">کاربر:
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <a class="btn btn-danger btn-sm d-inline" href="{{ route('logout') }}"
               onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">
                خروج
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>