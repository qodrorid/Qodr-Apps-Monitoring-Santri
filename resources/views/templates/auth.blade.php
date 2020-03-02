<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.base.head')
</head>

<body class="fix-menu">
    @include('components.base.preload')

    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    
    @include('components.base.footer')
</body>

</html>
