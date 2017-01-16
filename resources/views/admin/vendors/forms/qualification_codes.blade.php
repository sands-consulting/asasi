<div role="tabpanel" class="tab-pane" id="vendor-qualification-codes">
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Ministry of Finance</h6>
		</div>
		<div class="panel-body">
			<select name="qualification_codes[mof][codes][]" class="form-control select2" v-for="code in qualification_codes.mof" v-model="code">
				<option disabled="disabled">Search MOF Qualification Codes</option>
				@foreach(App\QualificationCode::whereTypeId(1)->get() as $code)
				<option value="{{ $code->id }}">{{ $code->code }} - {{ $code->name }}</option>
				@endforeach
			</select>

		</div>
	</div>
</div>