@if (session('success'))
    <script> notify("{{ session('success') }}", 'success');</script>
@elseif (session('error'))
    <script> notify("{{ session('error') }}", 'error');</script>
@endif