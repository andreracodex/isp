@if ($success = Session::get('success'))
    <script>
        notifier.show("Success !!", "{{ $success }}", "success", "{{ asset('/images/notification/ok-48.png') }}", 5000);
    </script>
@endif

@if ($erorr = session()->get('erorrs'))
    <script>
        notifier.show("Error !!", "{{ $erorr }}", "danger", "{{ asset('/images/notification/high_priority-48.png') }}", 5000);
    </script>
@endif

@if ($warning = session()->get('warning'))
    <script>
        notifier.show("Warning!", "{{ $warning }}", "warning", "{{ asset('/images/notification/medium_priority-48.png') }}", 5000);
    </script>
@endif

@if ($info = session()->get('info'))
    <script>
        notifier.show("Info!", "{{ $info }}", "info", "{{ asset('/images/notification/survey-48.png') }}", 5000);
    </script>
@endif

@if ($deleted = session()->get('deleted'))
    <script>
        notifier.show("Success !!", "{{ $deleted }}", "error", "{{ asset('/images/notification/ok-48.png') }}", 5000);
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            notifier.show("Sorry!", "{{ $error }}", "danger", "{{ asset('/images/notification/high_priority-48.png') }}", 5000);
        </script>
    @endforeach
@endif

