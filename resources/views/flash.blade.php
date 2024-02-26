@if (!empty($successmessage))
    <script>
        notifier.show("Success !!", "{{ $successmessage }}", "success", "{{ asset('/images/notification/ok-48.png') }}",
            5000);
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        notifier.show("Error !!", "{{ $message }}", "error",
            "{{ asset('/images/notification/high_priority-48.png') }}", 5000);
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
        notifier.show("Warning!", "{{ $message }}", "warning",
            "{{ asset('/images/notification/medium_priority-48.png') }}", 5000);
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        notifier.show("Info!", "{{ $message }}", "info", "{{ asset('/images/notification/survey-48.png') }}", 5000);
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            notifier.show("Sorry!", "{{ $error }}", "danger", "{{ asset('/images/notification/high_priority-48.png') }}",
                5000);
        </script>
    @endforeach
@endif

@if ($message = Session::get('deleted'))
    <script>
        notifier.show("Success !!", "{{ $message }}", "error", "{{ asset('/images/notification/ok-48.png') }}",
            5000);
    </script>
@endif
