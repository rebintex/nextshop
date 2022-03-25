





<li class="nav-item">
    <a href="{{ route('admin.categories.index') }}"
       class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}">
        <p>@lang('models/categories.plural')</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.products.index') }}"
       class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
        <p>@lang('models/products.plural')</p>
    </a>
</li>

