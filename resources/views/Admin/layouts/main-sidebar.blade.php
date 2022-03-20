<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="#">
            <img src="" class="header-brand-img desktop-logo" alt="logo">
            <img src="" class="header-brand-img toggle-logo" alt="logo">
            <img src="" class="header-brand-img light-logo" alt="logo">
            <img src="" class="header-brand-img light-logo1" alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>Elements</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="{{route('adminHome')}}">
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
            <a class="side-menu__item" href="{{route('category.index')}}">
                <i class="icon icon-menu side-menu__icon"></i>
                <span class="side-menu__label">Categories</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('product.index')}}">
                <i class="icon icon-handbag side-menu__icon"></i>
                <span class="side-menu__label">Products</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('visitors.index')}}">
                <i class="ti-face-smile side-menu__icon"></i>
                <span class="side-menu__label">Visitors Models</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('timing.index')}}">
                <i class="fe fe-watch side-menu__icon"></i>
                <span class="side-menu__label">Working Times</span>
            </a>
        </li>



        <li class="slide">
            <a class="side-menu__item" href="{{route('bracelet.index')}}">
                <i class="fe fe-bold side-menu__icon"></i>
                <span class="side-menu__label">Bracelets</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('reference.index')}}">
                <i class="fe fe-tag side-menu__icon"></i>
                <span class="side-menu__label">References</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('coupons.index')}}">
                <i class="fe fe-paperclip side-menu__icon"></i>
                <span class="side-menu__label">Coupons</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('users.index')}}">
                <i class="fe fe-user-plus side-menu__icon"></i>
                <span class="side-menu__label">Employees</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('capacities.index')}}">
                <i class="fe fe-calendar side-menu__icon"></i>
                <span class="side-menu__label">Days Capacity</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('clients.index')}}">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">Clients</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('sliders.index')}}">
                <i class="fe fe-camera side-menu__icon"></i>
                <span class="side-menu__label">Sliders</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('about_us.index')}}">
                <i class="fe fe-info side-menu__icon"></i>
                <span class="side-menu__label">About Page</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('contact_us.index')}}">
                <i class="fe fe-mail side-menu__icon"></i>
                <span class="side-menu__label">Contact Us
                    <span id="contact-span">

                    </span>
                </span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('general_setting.index')}}">
                <i class="fe fe-settings side-menu__icon"></i>
                <span class="side-menu__label">Setting</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{route('activity.index')}}">
                <i class="fe fe-zap side-menu__icon"></i>
                <span class="side-menu__label">Activities Page</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-hash side-menu__icon"></i>
                <span class="side-menu__label">Offers</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('offers.index')}}" class="slide-item">Show Offers</a></li>
                <li><a href="{{route('items.index')}}" class="slide-item">Offers Items</a></li>
            </ul>
        </li>

    </ul>
</aside>
