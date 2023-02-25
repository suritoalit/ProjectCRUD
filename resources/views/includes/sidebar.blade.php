<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        
        <li 
            class="sidebar-item {{ Request::is('users') ? 'active': ''}} ">
            <a href=" {{ route('users.index') }}"" class='sidebar-link'">
                <i class="bi bi-cash"></i>
                <span>Role-User</span>
            </a>
        </li>

        <li 
            class="sidebar-item {{ Request::is('users/trash') ? 'active': ''}} ">
            <a href=" {{ route('users.trash') }}"" class='sidebar-link'">
                <i class="bi bi-cash"></i>
                <span>Recycled Bin</span>
            </a>
        </li>

        <li 
            class="sidebar-item">
            <a href="#" class='sidebar-link' onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="bi bi-cash"></i>
                <span>Logout</span>
            </a>
            <form action="{{ route('logout') }}" method="post" id="logout-form" style="display:none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
