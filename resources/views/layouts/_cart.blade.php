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
			@forelse(Cart::content() as $cart)
			<li class="media">
				<div class="media-left"><i class="icon-cart-remove"></i></div>
				<div class="media-body">
					<a href="#" class="media-heading">
						<span class="text-semibold">{{ $cart->name }}</span>
						<span class="media-annotation pull-right">MYR {{ $cart->price }}</span>
					</a>

					{{-- <span class="text-muted">{{ str_limit($cart->options->description, 30) }}</span> --}}
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
			<a href="{{ route('carts.index') }}" data-popup="tooltip" title="" data-original-title="{{ trans('app.cart.view') }}"><i class="icon-menu display-block"></i></a>
		</div>
	</div>	
</li>