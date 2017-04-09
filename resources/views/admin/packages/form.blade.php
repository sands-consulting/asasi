{!! Former::text('name')->label('packages.attributes.name')->required() !!}
{!! Former::textarea('description')->label('packages.attributes.description')->required()->rows(5) !!}
{!! Former::select('validity_type')->options(trans('packages.validities'))->label('packages.attributes.validity_type')->required() !!}
{!! Former::text('validity_quantity')->label('packages.attributes.validity_quantity')->required() !!}
{!! Former::text('fee')->label('packages.attributes.fee')->required() !!}
{!! Former::select('tax_code_id')->options(App\TaxCode::options())->label('packages.attributes.tax_code')->required() !!}
{!! Former::select('color')->options(App\Package::colorOptions())->label('packages.attributes.color')->required() !!}
{!! Former::select('status')->label('packages.attributes.status')->options(collect(trans('statuses'))->only('active', 'inactive'))->required() !!}
