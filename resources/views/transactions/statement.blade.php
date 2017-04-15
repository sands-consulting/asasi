@extends('layouts.printing')

@section('content')
@include('admin.transactions.statement')
<script type="text/javascript">window.print();</script>
@endsection