@if ($message = Session::get('success'))
<script>
    $.notify("Success {{ $message }}", "success");
</script>
@endif

@if ($message = Session::get('error'))
<script>
    $.notify("Eror !! {{ $message }}", "error");
</script>
@endif

@if ($message = Session::get('warning'))
<script>
    $.notify("Warning !! {{ $message }}", "warn");
</script>
@endif

@if ($message = Session::get('info'))
<script>
    $.notify("Info !! {{ $message }}", "info");
</script>
@endif

@if ($errors->any())
<script>
    $.notify("Eror !! {{ $message }}", "error");
</script>
@endif

@if ($message = Session::get('deleted'))
<script>
    $.notify("Data !! {{ $message }}", "error");
</script>
@endif
