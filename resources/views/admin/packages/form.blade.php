{!! Former::text('name')
    ->label('packages.attributes.name')
    ->required() !!}
{!! Former::text('validity_type')
    ->label('packages.attributes.validity_type')
    ->required() !!}
{!! Former::text('validity_quantity')
    ->label('packages.attributes.validity_quantity')
    ->required() !!}
{!! Former::textarea('meta')
    ->label('packages.attributes.meta')
    ->rows(4)
    ->required() !!}
{!! Former::text('fee_amount')
    ->label('packages.attributes.fee_amount')
    ->required() !!}
{!! Former::text('fee_tax_code')
    ->label('packages.attributes.fee_tax_code')
    ->required() !!}
{!! Former::text('fee_tax_rate')
    ->label('packages.attributes.fee_tax_rate')
    ->required() !!}
