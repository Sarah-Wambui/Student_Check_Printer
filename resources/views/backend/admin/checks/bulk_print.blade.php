@foreach ($checks as $check)
    <div style="page-break-after: always;">
        @include('backend.admin.checks.print-content', ['check' => $check])
    </div>
@endforeach


