<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-coins"></i> Award</legend>
    @if ($vendorAwarded)
        <p>This notice has been awarded to {{ $vendorAwarded->name }}</p>
    @else
        <p>This notice is yet to be awarded.</p>
    @endif
</fieldset>
