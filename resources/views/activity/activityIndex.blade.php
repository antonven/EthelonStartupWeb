@extends('layouts.master')
@section ('additional_styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/css/normalize.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/fonts/font-awesome-4.3.0/css/font-awesome.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/css/demo.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/css/card.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('sbAssets/expan/css/pattern.css') }}" />

	<script>
	if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
		var root = document.getElementsByTagName('html')[0];
		root.setAttribute('class', 'ff');
	};
	</script>
@section('content')
<div class="container">
            <header class="codrops-header">
                			<div class="codrops-links">
				<a class="codrops-icon codrops-icon--prev" href="http://tympanus.net/Development/ColorExtraction/" title="Previous Demo"><span>Previous Demo</span></a>
				<a class="codrops-icon codrops-icon--drop" href="http://tympanus.net/codrops/?p=24222" title="Back to the article"><span>Back to the Codrops article</span></a>
			</div>
			<h1>Card Expansion Effect with SVG clipPath <span>Circular clip</span></h1>
			<nav class="codrops-demos">
				<a class="current-demo" href="index.html">Demo 1</a>
				<a href="index2.html">Demo 2</a>
				<a href="index3.html">Demo 3</a>
				<a href="index4.html">Demo 4</a>
			</nav>  
            </header>
            <div class="content">
                    <!-- trianglify pattern container -->
                    <div class="pattern pattern--hidden"></div>
                    <!-- cards -->
                    <div class="wrapper">

                            <div class="card">
                                    <div class="card__container card__container--closed">
                                            <svg class="card__image" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-150 0 1920 500" preserveAspectRatio="xMidYMid slice">
                                                    <defs>
                                                            <clipPath id="clipPath6">
                                                                    <!-- r = 992 = hyp = Math.sqrt(960*960+250*250) -->
                                                                    <circle class="clip" cx="960" cy="250" r="992"></circle>
                                                            </clipPath>
                                                    </defs>
                                                    <image clip-path="url(#clipPath6)" width="1920" height="500" xlink:href="{{ asset('sbAssets/expan/img/f.jpg') }}"></image>
                                            </svg>
                                            <div class="card__content">
                                                    <i class="card__btn-close fa fa-times"></i>
                                                    <div class="card__caption">
                                                            <h2 class="card__title">Freedom Fighters</h2>
                                                            <p class="card__subtitle">When it's too hot to think</p>
                                                    </div>
                                                    <div class="card__copy">
                                                            <div class="meta">
                                                                    <img class="meta__avatar" src="{{ asset('sbAssets/expan/img/authors/6.png') }}" alt="author06" />
                                                                    <span class="meta__author">Tom Goldman</span>
                                                                    <span class="meta__date">06/10/2015</span>
                                                            </div>
                                                            <p>Business model canvas bootstrapping deployment startup. In A/B testing pivot niche market alpha conversion startup down monetization partnership business-to-consumer success for investor mass market business-to-business.</p>
                                                            <p>Release creative social proof influencer iPad crowdsource gamification learning curve network effects monetization. Gamification business plan mass market www.discoverartisans.com direct mailing ecosystem seed round sales long tail vesting period.</p>
                                                            <p>Product management ramen bootstrapping seed round venture holy grail technology backing partner network entrepreneur beta marketing value proposition. Android stealth conversion scrum project network effects. Creative alpha long tail conversion stealth growth hacking iteration investor A/B testing prototype customer. Startup www.discoverartisans.com direct mailing launch party partnership market ramen metrics focus value proposition.</p>
                                                            <p>Stock infrastructure seed round sales paradigm shift technology user experience focus gamification. Partnership metrics business plan stealth business-to-business. Deployment graphical user interface monetization. Twitter incubator scrum project entrepreneur branding burn rate ramen backing paradigm shift virality crowdsource.</p>
                                                            <p>Social proof MVP ecosystem. Ramen launch party pitch deployment stealth. Vesting period MVP equity. Focus creative partnership founders iteration agile development infographic.</p>
                                                            <p>Low hanging fruit burn rate innovator user experience niche market A/B testing creative launch party product management release. Www.discoverartisans.com influencer business model canvas user experience gamification paradigm shift startup research &amp; development iPad agile development. Strategy incubator infographic success marketing buzz A/B testing responsive web design. Traction research &amp; development pitch seed money venture niche market accelerator network effects.</p>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <!-- /cards -->
            </div><!-- /content -->
            <!-- Related demos -->
            <section class="content content--related">
                    <p>If you enjoyed this demo you might also like:</p>
                    <a class="media-item" href="http://tympanus.net/Development/AnimatedGridLayout/">
                            <img class="media-item__img" src="img/related/GridItemAnimation.jpg">
                            <h3 class="media-item__title">Grid Item Animation Layout</h3>
                    </a>
                    <a class="media-item" href="http://tympanus.net/Tutorials/ThumbnailGridExpandingPreview/">
                            <img class="media-item__img" src="img/related/ThumbnailGridExpandingPreview.jpg">
                            <h3 class="media-item__title">Thumbnail Grid with Expanding Preview</h3>
                    </a>
            </section>
    </div>
@endsection
@section('additional_scripts')
	<script src="{{ asset('sbAssets/expan/js/vendors/trianglify.min.js') }}"></script>
	<script src="{{ asset('sbAssets/expan/js/vendors/TweenMax.min.js') }}"></script>
	<script src="{{ asset('sbAssets/expan/js/vendors/ScrollToPlugin.min.js') }}"></script>
	<script src="{{ asset('sbAssets/expan/js/vendors/cash.min.js') }}"></script>
	<script src="{{ asset('sbAssets/expan/js/Card-circle.js') }}"></script>
	<script src="{{ asset('sbAssets/expan/js/demo.js') }}"></script>
@endsection 