<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
	<title>المنتجات</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('template/images/icons/favicon.png') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css"
		href="{{ asset('template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css"
		href="{{ asset('template/fonts/iconic/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/slick/slick.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/MagnificPopup/magnific-popup.css') }}">
	<link rel="stylesheet" type="text/css"
		href="{{ asset('template/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
	<style>
		.block2-pic img {
			width: 100%;
			height: 300px;
			object-fit: cover;
		}
	</style>
</head>

<body class="animsition">

	<!-- Header -->
	<header class="header-v4">
		<div class="container-menu-desktop">
			<div class="top-bar">
				<div class="right-top-bar flex-w h-full">
					@auth
						<!-- لو المستخدم مسجل دخول -->
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							مرحباً، {{ auth()->user()->name }}
						</a>

						@if(auth()->user()->isAdmin())
							<!-- لو أدمن، يعرض رابط لوحة التحكم -->
							<a href="{{ url('/admin/categories') }}" class="flex-c-m trans-04 p-lr-25">
								لوحة التحكم
							</a>
						@endif

						<!-- زر تسجيل الخروج -->
						<form method="POST" action="{{ route('logout') }}" style="display: inline;">
							@csrf
							<button type="submit" class="flex-c-m trans-04 p-lr-25"
								style="background: none; border: none; cursor: pointer; color: inherit;">
								تسجيل الخروج
							</button>
						</form>
					@else
						<!-- لو المستخدم مش مسجل دخول -->
						<a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
							تسجيل الدخول
						</a>

						<a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
							إنشاء حساب
						</a>
					@endauth
				</div>
			</div>

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					<a href="{{ url('/') }}" class="logo">
						<img src="{{ asset('template/images/icons/logo-01.png') }}" alt="IMG-LOGO">
					</a>

					<div class="menu-desktop">
						<ul class="main-menu">
							<li><a href="{{ url('/') }}">الرئيسية</a></li>
							<li class="active-menu"><a href="{{ route('products') }}">المنتجات</a></li>
							<li><a href="{{ route('cart.index') }}">السلة</a></li>
						</ul>
					</div>

					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
							data-notify="{{ count(session()->get('cart', [])) }}">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
							data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<div class="logo-mobile">
				<a href="{{ url('/') }}"><img src="{{ asset('template/images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
			</div>

			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
					data-notify="{{ count(session()->get('cart', [])) }}">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
					data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li><a href="{{ url('/') }}">الرئيسية</a></li>
				<li><a href="{{ route('products') }}">المنتجات</a></li>
				<li><a href="{{ route('cart.index') }}">السلة</a></li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="{{ asset('template/images/icons/icon-close2.png') }}" alt="CLOSE">
				</button>
				<form class="wrap-search-header flex-w p-l-15" action="{{ route('search') }}" method="GET">
					<button type="submit" class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="ابحث عن منتج..." required>
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">سلتك</span>
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					@php
						$cart = session()->get('cart', []);
						$cartTotal = 0;
					@endphp

					@if(count($cart) > 0)
						@foreach($cart as $id => $item)
							@php
								$cartTotal += $item['price'] * $item['quantity'];
							@endphp
							<li class="header-cart-item flex-w flex-t m-b-12">
								<div class="header-cart-item-img">
									@if($item['image'])
										<img src="{{ asset('images/products/' . $item['image']) }}" alt="{{ $item['name'] }}">
									@else
										<img src="{{ asset('template/images/item-cart-01.jpg') }}" alt="{{ $item['name'] }}">
									@endif
								</div>
								<div class="header-cart-item-txt p-t-8">
									<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
										{{ $item['name'] }}
									</a>
									<span class="header-cart-item-info">
										{{ $item['quantity'] }} x ${{ $item['price'] }}
									</span>
								</div>
							</li>
						@endforeach
					@else
						<li class="text-center p-t-20 p-b-20">
							<p>السلة فارغة</p>
						</li>
					@endif
				</ul>

				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						الإجمالي: ${{ $cartTotal }}
					</div>
					<div class="header-cart-buttons flex-w w-full">
						<a href="{{ route('cart.index') }}"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							عرض السلة
						</a>
						<a href="{{ route('checkout') }}"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							إتمام الطلب
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<a href="{{ route('products') }}"
						class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ !request('category') ? 'how-active1' : '' }}">
						جميع المنتجات
					</a>

					@foreach($categories as $category)
						<a href="{{ route('products', ['category' => $category->id]) }}"
							class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request('category') == $category->id ? 'how-active1' : '' }}">
							{{ $category->name }}
						</a>
					@endforeach
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<form method="GET" action="{{ route('products') }}"
						class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4">
						@if(request('category'))
							<input type="hidden" name="category" value="{{ request('category') }}">
						@endif

						<select name="sort" class="stext-106 cl6 bg-transparent border-0" onchange="this.form.submit()"
							style="outline: none; padding: 10px;">
							<option value="">الترتيب الافتراضي</option>
							<option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>الاسم</option>
							<option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>السعر: من
								الأقل للأعلى</option>
							<option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>السعر: من
								الأعلى للأقل</option>
						</select>
					</form>
				</div>
			</div>

			<div class="row isotope-grid">
				@forelse($products as $product)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item category-{{ $product->category_id }}">
						<div class="block2">
							<div class="block2-pic hov-img0">
								@if($product->image)
									<img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}">
								@else
									<img src="{{ asset('template/images/product-01.jpg') }}" alt="{{ $product->name }}">
								@endif

								<a href="{{ route('product.show', $product->id) }}"
									class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
									عرض التفاصيل
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l">
									<a href="{{ route('product.show', $product->id) }}"
										class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										{{ $product->name }}
									</a>

									<span class="stext-105 cl3">
										@if($product->discount_price)
											<span
												style="text-decoration: line-through; color: #999;">${{ $product->price }}</span>
											<span
												style="color: #e65540; font-weight: bold;">${{ $product->discount_price }}</span>
										@else
											${{ $product->price }}
										@endif
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04"
											src="{{ asset('template/images/icons/icon-heart-01.png') }}" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l"
											src="{{ asset('template/images/icons/icon-heart-02.png') }}" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
				@empty
					<div class="col-12 text-center p-t-50 p-b-50">
						<p class="stext-102 cl3">لا توجد منتجات في هذه الفئة</p>
						<a href="{{ route('products') }}"
							class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 m-t-20">
							عرض جميع المنتجات
						</a>
					</div>
				@endforelse
			</div>

			<!-- Pagination -->
			@if($products->hasPages())
				<div class="flex-c-m flex-w w-full p-t-45">
					{{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
				</div>
			@endif
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">الفئات</h4>
					<ul>
						@foreach($categories as $category)
							<li class="p-b-10">
								<a href="{{ route('products', ['category' => $category->id]) }}"
									class="stext-107 cl7 hov-cl1 trans-04">
									{{ $category->name }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">روابط سريعة</h4>
					<ul>
						<li class="p-b-10">
							<a href="{{ url('/') }}" class="stext-107 cl7 hov-cl1 trans-04">الرئيسية</a>
						</li>
						<li class="p-b-10">
							<a href="{{ route('products') }}" class="stext-107 cl7 hov-cl1 trans-04">المنتجات</a>
						</li>
						<li class="p-b-10">
							<a href="{{ route('cart.index') }}" class="stext-107 cl7 hov-cl1 trans-04">السلة</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">تواصل معنا</h4>
					<p class="stext-107 cl7 size-201">
						متجر إلكتروني متكامل لبيع المنتجات
					</p>
					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-twitter"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="p-t-40">
				<p class="stext-107 cl6 txt-center">
					جميع الحقوق محفوظة &copy; {{ date('Y') }}
				</p>
			</div>
		</div>
	</footer>

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script src="{{ asset('template/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('template/vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('template/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('template/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('template/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('template/vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('template/vendor/slick/slick.min.js') }}"></script>
	<script src="{{ asset('template/js/slick-custom.js') }}"></script>
	<script src="{{ asset('template/vendor/parallax100/parallax100.js') }}"></script>
	<script src="{{ asset('template/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('template/vendor/isotope/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('template/vendor/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('template/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('template/js/main.js') }}"></script>
</body>

</html>