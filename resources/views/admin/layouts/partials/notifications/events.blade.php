<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-calendar-o"></i>
        <span class="label label-warning">{{ count($bugEvents) }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">There are {{ count($bugEvents) }} upapproved events</li>
        <li>
            <!-- inner menu: contains the messages -->
            <ul class="menu">
                @foreach ($bugEvents as $event)
                <li><!-- start message -->
                    <a href="/admin/event/{{ $event->id }}/edit">
                        <div class="pull-left">
                            <!-- User Image -->
                            <i class="fa fa-calendar bg-orange"></i>
                            {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                            {{ $event->title }}
                            
                        </h4>
                        <!-- The message -->
                        <p>{{ $event->location }}</p>
                        <p><small>{{ date('M d, Y', strtotime($event->start_date)) }}</small></p>
                    </a>
                </li>
                @endforeach
            </ul>
            <!-- /.menu -->
        </li>
        <li class="footer"><a href="/admin/event">See All Events</a></li>
    </ul>
</li>
<!-- /.messages-menu -->
