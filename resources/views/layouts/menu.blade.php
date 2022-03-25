





<li class="nav-item">
    <a href="{{ route('admin.categories.index') }}"
       class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
        <p>@lang('models/categories.plural')</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{ route('admin.brands.index') }}"
       class="nav-link {{ Request::is('admin/brands*') ? 'active' : '' }}">
        <p>@lang('models/brands.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.products.index') }}"
       class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
        <p>@lang('models/products.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.orders.index') }}"
       class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}">
        <p>@lang('models/orders.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.addresses.index') }}"
       class="nav-link {{ Request::is('admin/addresses*') ? 'active' : '' }}">
        <p>@lang('models/addresses.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.orderProducts.index') }}"
       class="nav-link {{ Request::is('admin/orderProducts*') ? 'active' : '' }}">
        <p>@lang('models/orderProducts.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.shoppingCarts.index') }}"
       class="nav-link {{ Request::is('admin/shoppingCarts*') ? 'active' : '' }}">
        <p>@lang('models/shoppingCarts.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.favourites.index') }}"
       class="nav-link {{ Request::is('admin/favourites*') ? 'active' : '' }}">
        <p>@lang('models/favourites.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.coupons.index') }}"
       class="nav-link {{ Request::is('admin/coupons*') ? 'active' : '' }}">
        <p>@lang('models/coupons.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.features.index') }}"
       class="nav-link {{ Request::is('admin/features*') ? 'active' : '' }}">
        <p>@lang('models/features.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.featureValues.index') }}"
       class="nav-link {{ Request::is('admin/featureValues*') ? 'active' : '' }}">
        <p>@lang('models/featureValues.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.comments.index') }}"
       class="nav-link {{ Request::is('admin/comments*') ? 'active' : '' }}">
        <p>@lang('models/comments.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.posts.index') }}"
       class="nav-link {{ Request::is('admin/posts*') ? 'active' : '' }}">
        <p>@lang('models/posts.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.pages.index') }}"
       class="nav-link {{ Request::is('admin/pages*') ? 'active' : '' }}">
        <p>@lang('models/pages.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.tags.index') }}"
       class="nav-link {{ Request::is('admin/tags*') ? 'active' : '' }}">
        <p>@lang('models/tags.plural')</p>
    </a>
</li>

