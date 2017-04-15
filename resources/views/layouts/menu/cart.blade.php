@if(Auth::check() && Auth::user()->hasPermission('access:vendor') && Auth::user()->vendor->status == 'active')
<li class="dropdown">
	<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
		<i class="icon-cart4"></i>
		<span class="visible-xs-inline-block position-right">{{ trans('menu.app.cart') }}</span>
		@if (Cart::count() > 0)<span class="badge bg-warning-400">{{ Cart::count() }}</span>@endif
	</a>
	
	<div class="dropdown-menu dropdown-content">
		<div class="dropdown-content-heading">
			{{ trans('app.cart.title') }}
			<ul class="icons-list"><li><a href="#"><i class="icon-cart4"></i></a></li></ul>
		</div>
		
		<ul class="media-list dropdown-content-body width-350">
			@forelse(Cart::content() as $item)
			<li class="media">
				<div class="media-left">
					<a href="{{ route('cart.remove', $item->rowId) }}" class="text-danger" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross3"></i></a>
				</div>
				<div class="media-body">
					<a href="{{ route('cart') }}" class="media-heading">
						<span class="text-default text-light">{{ $item->model->number }}</span><br>
						<span class="text-default text-semibold">{{ $item->name }}</span>
					</a>

				</div>
			</li>
			@empty
			<li class="media">
				<div class="media-body">
					<p class="text-center"><span class="text-muted">{{ trans('app.cart.empty') }}</span></p>
				</div>
			</li>
			@endforelse
		</ul>

		<div class="dropdown-content-footer">
			<a href="{{ route('cart') }}" data-popup="tooltip" title="" data-original-title="{{ trans('app.cart.view') }}"><i class="icon-menu display-block"></i></a>
		</div>
	</div>	
</li>
@endif
