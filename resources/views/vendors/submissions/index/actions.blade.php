@if (! $notice->submitted_at)
    <a href="{{ route('vendors.submissions.show', [$notice->vendor_id, $notice->submission_id]) }}"
       class="btn btn-default btn-sm">
        View
    </a>
@endif