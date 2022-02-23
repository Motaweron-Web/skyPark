<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="#">
            <img src="{{asset('assets/uploads')}}/logo.png" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{asset('assets/uploads')}}/logo.png" class="header-brand-img toggle-logo" alt="logo">
            <img src="{{asset('assets/uploads')}}/logo.png" class="header-brand-img light-logo" alt="logo">
            <img src="{{asset('assets/uploads')}}/logo.png" class="header-brand-img light-logo1" alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>Elements</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="">
                <i class="icon icon-home side-menu__icon"></i>
                <span class="side-menu__label">Home</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('admins.index')}}">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">Admins</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="">
                <i class="fe fe-mail side-menu__icon"></i>
                <span class="side-menu__label">Contact Us</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/widgets">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                <span class="side-menu__label">Widgets</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/maps">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4C9.24 4 7 6.24 7 9c0 2.85 2.92 7.21 5 9.88 2.11-2.69 5-7 5-9.88 0-2.76-2.24-5-5-5zm0 7.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" opacity=".3"/><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"/><circle cx="12" cy="9" r="2.5"/></svg>
                <span class="side-menu__label">Maps</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
                <span class="side-menu__label">Mail</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/email-compose" class="slide-item">Mail-Compose</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/email-inbox" class="slide-item">Mail-Inbox</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/email-view" class="slide-item">View-Mail</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm2.01 10.01L6.5 17.5l3.49-7.51L17.5 6.5l-3.49 7.51z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5.5-2.5l7.51-3.49L17.5 6.5 9.99 9.99 6.5 17.5zm5.5-6.6c.61 0 1.1.49 1.1 1.1s-.49 1.1-1.1 1.1-1.1-.49-1.1-1.1.49-1.1 1.1-1.1z"/></svg>
                <span class="side-menu__label">Components</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/cards" class="slide-item"> Cards design</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/calendar" class="slide-item"> Default calendar</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/calendar2" class="slide-item"> Full calendar</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chat" class="slide-item"> Default Chat</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/notify" class="slide-item"> Notifications</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/sweetalert" class="slide-item"> Sweet alerts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/rangeslider" class="slide-item"> Range slider</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/scroll" class="slide-item"> Content Scroll bar</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/loaders" class="slide-item"> Loaders</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/counters" class="slide-item"> Counters</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/rating" class="slide-item"> Rating</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/timeline" class="slide-item"> Timeline</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg>
                <span class="side-menu__label">Elements</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/alerts" class="slide-item"> Alerts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/buttons" class="slide-item"> Buttons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/dropdown" class="slide-item"> Dropdowns</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/colors" class="slide-item"> Colors</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/avatarsquare" class="slide-item"> Avatar-Square</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/avatar-round" class="slide-item"> Avatar-Rounded</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/avatar-radius" class="slide-item"> Avatar-Radius</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/list" class="slide-item"> Lists & ListGroups</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/tags" class="slide-item"> Tags</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/pagination" class="slide-item"> Pagination</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/navigation" class="slide-item"> Navigation</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/typography" class="slide-item"> Typography</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/breadcrumbs" class="slide-item"> Breadcrumbs</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/badge" class="slide-item"> Badges</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/jumbotron" class="slide-item"> Jumbotron</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/panels" class="slide-item"> Panels</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/thumbnails" class="slide-item"> Thumbnails</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 9h14V5H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5S7.83 8.5 7 8.5 5.5 7.83 5.5 7 6.17 5.5 7 5.5zM5 19h14v-4H5v4zm2-3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5z" opacity=".3"/><path d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zm-1 6H5v-4h14v4zm-12-.5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zm-1 6H5V5h14v4zM7 8.5c.83 0 1.5-.67 1.5-1.5S7.83 5.5 7 5.5 5.5 6.17 5.5 7 6.17 8.5 7 8.5z"/></svg>
                <span class="side-menu__label">Advanced Elements</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/mediaobject" class="slide-item"> Media Object</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/accordion" class="slide-item"> Accordions</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/tabs" class="slide-item"> Tabs</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/modal" class="slide-item"> Modal</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/tooltipandpopover" class="slide-item"> Tooltip and popover</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/progress" class="slide-item"> Progress</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/carousel" class="slide-item"> Carousels</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/headers" class="slide-item"> Headers</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/footers" class="slide-item"> Footers</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/users-list" class="slide-item"> User List</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/search" class="slide-item">Search</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/crypto-currencies" class="slide-item"> Crypto-currencies</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"  class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5v14h14V5H5zm4 12H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg>
                <span class="side-menu__label">Charts</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-chartist" class="slide-item">Chart Js</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-flot" class="slide-item"> Flot Charts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-echart" class="slide-item"> ECharts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-morris" class="slide-item"> Morris Charts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-nvd3" class="slide-item"> Nvd3 Charts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/charts" class="slide-item"> C3 Bar Charts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-line" class="slide-item"> C3 Line Charts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-donut" class="slide-item"> C3 Donut Charts</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/chart-pie" class="slide-item"> C3 Pie charts</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h15v3H5zm12 5h3v9h-3zm-7 0h5v9h-5zm-5 0h3v9H5z" opacity=".3"/><path d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM8 19H5v-9h3v9zm7 0h-5v-9h5v9zm5 0h-3v-9h3v9zm0-11H5V5h15v3z"/></svg>
                <span class="side-menu__label">Tables</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/tables" class="slide-item">Default table</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/datatable" class="slide-item"> Data Tables</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5z" opacity=".3"/><path d="M20 8l-6-6H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8zm-2 12H6V4h7v5h5v11z"/></svg>
                <span class="side-menu__label">Forms</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/form-elements" class="slide-item"> Form Elements</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/wysiwyag" class="slide-item"> Form Editor</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/form-wizard" class="slide-item"> Form Wizard</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" opacity=".3"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z"/><circle cx="6.5" cy="11.5" r="1.5"/><circle cx="9.5" cy="7.5" r="1.5"/><circle cx="14.5" cy="7.5" r="1.5"/><circle cx="17.5" cy="11.5" r="1.5"/></svg>
                <span class="side-menu__label">Icons</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons" class="slide-item"> Font Awesome</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons2" class="slide-item"> Material Design Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons3" class="slide-item"> Simple Line Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons4" class="slide-item"> Feather Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons5" class="slide-item"> Ionic Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons6" class="slide-item"> Flag Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons7" class="slide-item"> pe7 Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons8" class="slide-item"> Themify Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons9" class="slide-item">Typicons Icons</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/icons10" class="slide-item">Weather Icons</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7 3h14v14H7z" opacity=".3"/><path d="M3 23h16v-2H3V5H1v16c0 1.1.9 2 2 2zM21 1H7c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V3c0-1.1-.9-2-2-2zm0 16H7V3h14v14z"/></svg>
                <span class="side-menu__label">Pages</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/profile" class="slide-item"> Profile</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/editprofile" class="slide-item"> Edit Profile</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/gallery" class="slide-item"> Gallery</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/about" class="slide-item"> About Company</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/services" class="slide-item"> Services</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/faq" class="slide-item"> FAQS</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/terms" class="slide-item"> Terms</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/invoice" class="slide-item"> Invoice</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/pricing" class="slide-item"> Pricing Tables</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/blog" class="slide-item"> Blog</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/empty" class="slide-item"> Empty Page</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/construction" class="slide-item"> Under Construction</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.55 11l2.76-5H6.16l2.37 5z" opacity=".3"/><path d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                <span class="side-menu__label">E-Commerce</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/shop" class="slide-item"> Shop</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/shop-description" class="slide-item">Product Details</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/cart" class="slide-item"> Shopping Cart</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8zm0 12.5c-2.49 0-4.5-2.01-4.5-4.5S9.51 7.5 12 7.5s4.5 2.01 4.5 4.5-2.01 4.5-4.5 4.5z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-12.5c-2.49 0-4.5 2.01-4.5 4.5s2.01 4.5 4.5 4.5 4.5-2.01 4.5-4.5-2.01-4.5-4.5-4.5zm0 5.5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/></svg>
                <span class="side-menu__label">Custom Pages</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/login" class="slide-item"> Login</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/register" class="slide-item"> Register</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/forgot-password" class="slide-item"> Forgot Password</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/lockscreen" class="slide-item"> Lock screen</a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9.1 5L5 9.1v5.8L9.1 19h5.8l4.1-4.1V9.1L14.9 5H9.1zM12 17c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm1-3h-2V7h2v7z" opacity=".3"/><path d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM19 14.9L14.9 19H9.1L5 14.9V9.1L9.1 5h5.8L19 9.1v5.8z"/><circle cx="12" cy="16" r="1"/><path d="M11 7h2v7h-2z"/></svg>
                <span class="side-menu__label">Error Pages</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/400" class="slide-item"> 400</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/401" class="slide-item"> 401</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/403" class="slide-item"> 403</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/404" class="slide-item"> 404</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/500" class="slide-item"> 500</a></li>
                <li><a href="https://laravel.spruko.com/yoha/Sidemenu-Icon-Light-rtl/503" class="slide-item"> 503</a></li>
            </ul>
        </li>
    </ul>
</aside>
