@extends('layouts.printing')

@section('content')
@include('admin.transactions.invoice')
<script type="text/javascript">window.print();</script>
@endsection