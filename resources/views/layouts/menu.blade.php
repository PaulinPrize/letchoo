<li class="nav-item">
   <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
      <p>Roles</p>
   </a>
</li>
<li class="nav-item">
    <a href="{{ route('permissions.index') }}"
       class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
        <p>Permissions</p>
    </a>
</li>


