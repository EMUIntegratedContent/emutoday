<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-blind"></i>
        <span class="label label-info">{{ count($bugExperts) + count($bugExpertMediaRequests) }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">There are {{ count($bugExperts) }} new experts and {{ count($bugExpertMediaRequests) }} new media requests.</li>
        <li>
            <!-- inner menu: contains the messages -->
            <ul class="menu">
                @foreach ($bugExperts as $expert)
                <li>
                    <a href="/admin/experts/{{ $expert->id }}/edit">
                        <div class="pull-left">
                            <i class="fa fa-blind bg-blue"></i>
                        </div>
                        <h4>
                            {{ $expert->display_name }}
                        </h4>
                        <p>{{ $expert->title }}</p>
                        <p><small>Submitted: {{ date('M d, Y', strtotime($expert->created_at)) }}</small></p>
                    </a>
                </li>
                @endforeach
                @foreach ($bugExpertMediaRequests as $request)
                <li>
                    <a href="/admin/expertrequests/{{ $request->id }}/edit">
                        <div class="pull-left">
                            <i class="fa fa-microphone"></i>
                        </div>
                        <h4>Media Request</h4>
                        <p>From: {{ $request->name }}</p>
                        <p>Outlet: {{ $request->media_outlet }}</p>
                        <p><small>Submitted: {{ date('M d, Y', strtotime($request->created_at)) }}</small></p>
                    </a>
                </li>
                @endforeach
            </ul>
            <!-- /.menu -->
        </li>
        <li class="footer"><a href="/admin/experts">All experts</a> <a href="/admin/expertrequests">All media requests</a></li>
    </ul>
</li>
<!-- /.messages-menu -->
