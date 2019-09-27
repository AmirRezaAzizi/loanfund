<nav class="col-md-2 d-none d-md-block bg-light sidebar no-print">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link {{ request()->is('/') ? 'active' : ''}}" href="/">--}}
                    {{--<i class="fas fa-home"></i>--}}
                    {{--داشبورد--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('customers*')  ? 'active' : ''}}" href="/customers">
                    <i class="fas fa-users"></i>
                    اعضا
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('bankbooks*') ? 'active' : ''}}" href="/bankbooks">
                    <i class="fas fa-users"></i>
                    دفاتر
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('loans*') ? 'active' : ''}}" href="/loans">
                    <i class="fas fa-users"></i>
                    وام ها
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('journal*') ? 'active' : ''}}" href="/journal">
                    <i class="fas fa-users"></i>
                    دفتر روزنامه
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('backup*') ? 'active' : ''}}" href="/backup">
                    <i class="fas fa-users"></i>
                    پشتیبان گیری
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>بخش دوم</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('bankbooks/inactive') ? 'active' : ''}}" href="/bankbooks/inactive">
                    <i class="fas fa-users"></i>
                    دفاتر غیرفعال
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('loans/inactive') ? 'active' : ''}}" href="/loans/inactive">
                    <i class="fas fa-users"></i>
                    وام های غیرفعال
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('customers/inactive') ? 'active' : ''}}" href="/customers/inactive">
                    <i class="fas fa-users"></i>
                    اعضا غیرفعال
                </a>
            </li>
        </ul>
    </div>
</nav>
