<!-- Tasks Menu -->
<li class="dropdown tasks-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-lightbulb-o"></i>
        <span class="label label-primary">{{ count($bugInsideemuIdeas) }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">There are {{ count($bugInsideemuIdeas) }} new Inside EMU submissions.</li>
        <li>
            <!-- Inner menu: contains the tasks -->
            <ul class="menu">
                @foreach ($bugInsideemuIdeas as $idea)
                <li><!-- start message -->
                    <a href="/admin/insideemu/ideas/{{ $idea->id }}">
                        <i class="fa fa-lightbulb-o text-green"></i> {{ $idea->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer">
            <a href="/admin/insideemu/ideas">View all submissions</a>
        </li>
    </ul>
</li>
