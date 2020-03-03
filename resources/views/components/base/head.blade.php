<title>{{ env('APP_NAME', 'Qodr Apps Monitoring Santri') }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('img/master/favicon.ico') }}" type="image/x-icon">
{{ HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:400,600') }}
{{ HTML::style('plugins/bootstrap/css/bootstrap.min.css') }}
{{ HTML::style('plugins/icons/themify/themify-icons.css') }}
{{ HTML::style('plugins/icons/icofont/css/icofont.css') }}
{{ HTML::style('plugins/icons/feather/css/feather.css') }}
{{ HTML::style('plugins/sweetalert/sweetalert.min.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::style('css/jquery.mCustomScrollbar.css') }}
{{ HTML::style('css/app.css') }}
@yield('stylesheet')
<script>
function urlbase(url) {
    let base = '{{ url('/') }}'
    return base + (url || '')
}
</script>