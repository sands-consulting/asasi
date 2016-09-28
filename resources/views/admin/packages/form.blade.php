<fieldset>
    <legend class="text-semibold">
        <i class="icon-file-text2 position-left"></i>
        {{ trans('packages.views.edit.legend') }}
    </legend>
    <div class="row">
        <div class="col-sm-4"> 
            {!! Former::text('name')
                ->label('packages.attributes.name')
                ->required() !!}
        </div>
        <div class="col-sm-4"> 
            {!! Former::select('label_color')
                ->options([
                    '' => 'Select',
                    'blue-800' => '<span class="label bg-blue-800">Blue</span>',
                    'indigo-800' => '<span class="label bg-indigo-800">Indigo</span>',
                    'green-800' => '<span class="label bg-green-800">Green</span>',
                    'pink-800' => '<span class="label bg-pink-800">Pink</span>',
                ])
                ->label('packages.attributes.label_color')
                ->addClass('select')
                ->required() !!}
        </div>
        <div class="col-sm-4"> 
            {!! Former::select('validity_type')
                ->options([
                    '' => 'Select',
                    'days' => 'Days',
                    'months' => 'Months',
                    'years' => 'Years',
                ])
                ->label('packages.attributes.validity_type')
                ->required() !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('validity_quantity')
                ->label('packages.attributes.validity_quantity')
                ->required() !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('fee_amount')
                ->label('packages.attributes.fee_amount')
                ->required() !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('fee_tax_code')
                ->label('packages.attributes.fee_tax_code')
                ->required() !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('fee_tax_rate')
                ->label('packages.attributes.fee_tax_rate')
                ->required() !!}
        </div>
    </div>
</fieldset>
