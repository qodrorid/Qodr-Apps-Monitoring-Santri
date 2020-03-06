<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.base.head')
</head>

<body>
@include('components.base.preload')

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('components.header')
        
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('components.sidebar')

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.base.footer')
{{ HTML::script('js/vartical-layout.min.js') }}
</body>
</html>