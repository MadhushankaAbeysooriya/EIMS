<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('students.index')}}" class="nav-link
    {{ request()->routeIs('students.edit','students.index','students.create','students.show','students.add_class_room_view')?'active':'' }}">
        <i class="nav-icon fas fa-user-graduate"></i>
            <p>Student</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('guardiances.index')}}" class="nav-link
    {{ request()->routeIs('guardiances.edit','guardiances.index','guardiances.create','guardiances.show','guardiances.add_children_view')?'active':'' }}">
        <i class="nav-icon fas fa-user-friends"></i>
            <p>Guardiance</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('announcements.index')}}" class="nav-link
    {{ request()->routeIs('announcements.index','announcements.edit', 'announcements.create')?'active':'' }}">
        <i class="nav-icon fas fa-bullhorn"></i>
            <p>Announcement</p>
    </a>
</li>

<li class="nav-item {{ request()->routeIs('class_rooms*','semesters*','guardiance_types*','message_types*','groups*')?'menu-open':'' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs"></i>
            <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
            </p>
    </a>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('class_rooms.index')}}" class="nav-link
            {{ request()->routeIs('class_rooms.edit','class_rooms.index')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>Class</p>
            </a>
        </li>
    </ul>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('semesters.index')}}" class="nav-link
            {{ request()->routeIs('semesters.edit','semesters.index')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>Semester</p>
            </a>
        </li>
    </ul>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('guardiance_types.index')}}" class="nav-link
            {{ request()->routeIs('guardiance_types.edit','guardiance_types.index')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>Guardiance Types</p>
            </a>
        </li>
    </ul>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('message_types.index')}}" class="nav-link
            {{ request()->routeIs('message_types.edit','message_types.index')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>Message Types</p>
            </a>
        </li>
    </ul>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('groups.index')}}" class="nav-link
            {{ request()->routeIs('groups*')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>Groups</p>
            </a>
        </li>
    </ul>

</li>


<li class="nav-item {{ request()->routeIs('users*', 'roles*')?'menu-open':'' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                System Management
                <i class="right fas fa-angle-left"></i>
            </p>
    </a>


    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('roles.index')}}" class="nav-link
            {{ request()->routeIs('roles.edit','roles.index')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>User Roles</p>
            </a>
        </li>
    </ul>

    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link
            {{ request()->routeIs('users.index','users.edit')?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                    <p>User</p>
            </a>
        </li>
    </ul>

</li>

