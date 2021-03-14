<li class="dropdown notifications-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bug"></i>
        <span class="label label-alert"></span>
    </a>
    <ul class="dropdown-menu">
        {{-- <li class="header">You have tracked 4 bugz</li> --}}
        <li>
            <!-- inner menu: contains the messages -->
            <ul class="menu">
                @include('admin.bugz.subview.miniform')
            </ul>
            <!-- /.menu -->
        </li>
        <li class="footer"><a href="#" class="btn btn-info expanded btn-xs" data-toggle="collapse">close</a>
        </li>
    </ul>
</li>
