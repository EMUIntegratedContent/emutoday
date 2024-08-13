<!-- Notifications Menu -->
<li class="dropdown notifications-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bullhorn"></i>
        <span class="label label-danger">{{ count($bugAnnouncements) }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">There are {{ count($bugAnnouncements) }} unapproved announcements</li>
        <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
                @foreach ($bugAnnouncements as $announcement)
                <li>
                    <a href="/admin/announcement/{{ $announcement->id }}/edit">
                        <i class="fa fa-bullhorn text-red"></i> {{ $announcement->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="/admin/announcement/queue/general">View all</a></li>
    </ul>
</li>
