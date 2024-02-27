@if (!empty($success))
    <script>
        notifier.show("Success !!", "{{ $success }}", "success", "{{ asset('/images/notification/ok-48.png') }}", 5000);
    </script>
@endif

@if (!empty($erorr))
    <script>
        notifier.show("Error !!", "{{ $erorr }}", "error", "{{ asset('/images/notification/high_priority-48.png') }}", 5000);
    </script>
@endif

@if (!empty($warning))
    <script>
        notifier.show("Warning!", "{{ $warning }}", "warning", "{{ asset('/images/notification/medium_priority-48.png') }}", 5000);
    </script>
@endif

@if (!empty($info))
    <script>
        notifier.show("Info!", "{{ $info }}", "info", "{{ asset('/images/notification/survey-48.png') }}", 5000);
    </script>
@endif

@if (!empty($deleted))
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

