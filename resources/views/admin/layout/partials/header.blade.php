<div class="slim-header">
    <div class="container">
        <div class="slim-header-left">
            <h2 class="slim-logo"><a href="{{ route('admin.dashboard') }}">PRNEWSLAND</a></h2>
        </div>
        <div class="slim-header-right">
            <div class="dropdown dropdown-c">
                <a href="#" class="logged-user" data-toggle="dropdown">
                    <img src="http://via.placeholder.com/500x500" alt="">
                    <span>{{ getCurrentAdmin()->name }}</span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <nav class="nav">
                        <a href="{{ route('admin.logout') }}" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>