<!doctype html>
<html lang="en">
@include('owner/layouts/head')

  <body class="rtl">
    @include('owner/layouts/navbar-top')

    <div class="container-fluid">
      @include('owner/layouts/navbar-right')

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          @yield('page-title')
        </div>
        @include('owner/layouts/flash-message')
        @yield('content')
      </main>
    </div>

@include('owner/layouts/footer-scripts')

  </body>
</html>
