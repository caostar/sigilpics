@if (session()->has('flash_notification.message'))
    <script>
    	alert("{!! session('flash_notification.message') !!}");
    </script>
@endif