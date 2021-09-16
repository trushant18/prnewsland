<footer class="footer-v6 v8">
    <div class="container">
        <div class="footer-content-v6">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget-abt wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0ms">
                        <h2>Boost your business up to high level</h2>
                        <h2>Start by<a href="#" title=""> saying hi</a></h2>
                    </div><!--widget-abt end-->
                </div>
                <div class="col-lg-6">
                    <div class="get-touch-txt mw-100 wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="0ms">
                        <h5>contact</h5>
                        <h4>{{ $site_configuration['address'] ?? "" }}</h4>
                        <a href="#" title="">{{ $site_configuration['email_address'] ?? "" }}</a>
                        <ul>
                            <li><a href="{{ route('blogs') }}" title="">Blogs</a></li>
                            <li><a href="{{ route('page.detail', 'about-us') }}" title="">About</a></li>
                            <li><a href="#" title="">News</a></li>
                            <li><a href="{{ route('contact') }}" title="">Contact</a></li>
                        </ul>
                    </div><!--get-touch-txt end-->
                </div>
            </div>
            <div class="mile-bottom-footer">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="btm-copy">
                            <img src="{{ url('front/images/logo.png') }}" alt="">
                            <p>© 2020. All Rights Reserved</p>
                        </div><!--btm-copy end-->
                    </div>
                    <div class="col-lg-4">
                        <ul class="social-header">
                            <li><a href="#" title=""><i class="lni lni-twitter-original"></i></a></li>
                            <li><a href="#" title=""><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="#" title=""><i class="lni lni-instagram-original"></i></a></li>
                            <li><a href="#" title=""><i class="lni lni-pinterest"></i></a></li>
                            <li><a href="#" title=""><i class="lni lni-youtube"></i></a></li>
                        </ul><!--social-header end-->
                    </div>
                </div>
            </div><!--mile-bottom-footer end-->
        </div><!--footer-content-v6 end-->
    </div>
</footer>
