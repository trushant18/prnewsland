<div class="slim-navbar">
    <div class="container">
        <ul class="nav">
            <li class="nav-item @if(Request::is('admin/dashboard')) active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="icon ion-ios-home-outline"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item @if(Request::is('admin/users')) active @endif">
                <a class="nav-link" href="{{ route('admin.users') }}">
                    <i class="icon ion-ios-person"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item with-sub @if(Request::is('admin/blog') || Request::is('admin/blog/*') || Request::is('admin/plans') || Request::is('admin/plan/*')) active @endif">
                <a class="nav-link" href="#">
                    <i class="icon ion-document-text"></i>
                    <span>Catalog</span>
                </a>
                <div class="sub-item">
                    <ul>
                        <li><a href="{{ route('admin.news') }}">News List</a></li>
                        <li><a href="{{ route('admin.blog') }}">Our Blog</a></li>
                        <li><a href="{{ route('admin.plans') }}">Price Plans</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item with-sub @if(Request::is('admin/contact_requests')) active @endif">
                <a class="nav-link" href="#">
                    <i class="icon ion-navicon-round"></i>
                    <span>Reports</span>
                </a>
                <div class="sub-item">
                    <ul>
                        <li><a href="{{ route('admin.news.payment_history') }}">Payment History</a></li>
                        <li><a href="{{ route('admin.contact_requests') }}">Contact Requests</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item with-sub @if(Request::is('admin/newsletter') || Request::is('admin/pages') || Request::is('admin/page/*') || Request::is('admin/email_templates') ||
                Request::is('admin/email_template/*') || Request::is('admin/site_configurations')) active @endif">
                <a class="nav-link" href="#">
                    <i class="icon ion-gear-b"></i>
                    <span>System</span>
                </a>
                <div class="sub-item">
                    <ul>
                        <li><a href="{{ route('admin.newsletter') }}">Send Newsletter</a></li>
                        <li><a href="{{ route('admin.pages') }}">CMS Pages</a></li>
                        <li><a href="{{ route('admin.email_templates') }}">Email Templates</a></li>
                        <li><a href="{{ route('admin.site_configurations') }}">Site Configurations</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>