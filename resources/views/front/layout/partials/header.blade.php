@if(url()->current() == route('home'))
    <header class="header-v8">
        <div class="container">
            <div class="header-content-v8">
                <div class="logo-v8">
                    <a href="{{ route('home') }}" title="">
                        <img src="{{ url('front/images/logo.png') }}" alt="">
                    </a>
                </div><!--logo-v8 end-->
                <nav>
                    <ul>
                        <li><a class="active" href="{{ route('page.detail', 'about-us') }}" title="">About</a></li>
                        <li><a href="{{ route('blogs') }}" title="">Blogs</a></li>
                        <li><a href="{{ route('news_list') }}" title="">News</a></li>
                        <li><a href="{{ route('pricing') }}" title="">Pricing</a></li>
                        <li><a href="{{ route('contact') }}" title="">Contact</a></li>
                    </ul>
                </nav><!--nav end-->
                @if(auth()->check())
                    <a href="{{ route('user.dashboard') }}" title="" class="chat-btn">Dashboard </a>
                @else
                    <a href="{{ route('user.login') }}" title="" class="chat-btn">Let’s connect! <i
                                class="lni lni-comments-reply"></i></a>
                @endif
                <button class="nav-toggle-btn a-nav-toggle ml-auto">
						<span class="nav-toggle nav-toggle-sm">
							<span class="stick stick-1"></span>
							<span class="stick stick-2"></span>
							<span class="stick stick-3"></span>
						</span>
                </button>
            </div><!--header-content-v8 end-->
        </div>
    </header><!--header end-->
@else
    <header>
        <div class="container-fluid">
            <div class="header-content d-flex flex-wrap align-items-center">
                <div class="logo">
                    <a href="{{ route('home') }}" title=""><img src="{{ url('front/images/logo.png') }}"
                                                                alt=""></a>
                </div><!--logo end-->
                <div class="mile-right ml-auto">
                    <button class="nav-toggle-btn a-nav-toggle ml-auto">
                        <span class="nav-toggle-title">Menu</span>
                        <span class="nav-toggle nav-toggle-sm">
								<span class="stick stick-1"></span>
								<span class="stick stick-2"></span>
								<span class="stick stick-3"></span>
							</span>
                    </button>
                    @if(auth()->check())
                        <a href="{{ route('user.dashboard') }}" title="" class="btn-default no-bg">Dashboard</a>
                    @else
                        <a href="{{ route('user.login') }}" title="" class="btn-default no-bg">Let’s connect!<i
                                    class="lni lni-comments"></i></a>
                    @endif
                </div><!--mile-right end-->
            </div><!--header-content end-->
        </div>
    </header><!--header end-->
@endif
<div class="responsive-menu">
    <div class="rep-header">
        <div class="rep-logo">
            <img src="{{ url('front/images/logo.png') }}" alt="">
        </div>
        <a href="#" title="" class="close-menu"><i class="lni lni-close"></i></a>
    </div>
    {{--<div class="search-box">
        <form>
            <input type="text" name="search" placeholder="Search">
            <button type="submit"><i class="lni lni-search-alt"></i></button>
        </form>
    </div>--}}
    <ul class="mobile-menu">
        <li>
            <a class="active" href="{{ route('home') }}" title="">Home</a>
        </li>
        <li><a href="{{ route('page.detail', 'about-us') }}" title="">About</a>
        </li>
        <li><a href="{{ route('blogs') }}" title="">Blogs</a></li>
        <li><a href="{{ route('pricing') }}" title="">Pricing</a></li>
        <li><a href="{{ route('page.detail', 'contact') }}" title="">Contact</a></li>
    </ul>
</div><!--responsive-menu end-->
