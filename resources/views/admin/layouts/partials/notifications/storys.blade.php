<!-- Tasks Menu -->
<li class="dropdown tasks-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-files-o"></i>
        <span class="label label-success">{{ count($bugStories) }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">There are {{ count($bugStories) }} unapproved stories.</li>
        <li>
            <!-- Inner menu: contains the tasks -->
            <ul class="menu">
                @foreach ($bugStories as $story)
                <li><!-- start message -->
                    <a href="/admin/story/{{ $story->id }}/edit">
                        <i class="fa fa-file-text text-green"></i> {{ $story->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
        <li class="footer">
            <a href="/admin/story">View all stories</a>
        </li>
    </ul>
</li>
