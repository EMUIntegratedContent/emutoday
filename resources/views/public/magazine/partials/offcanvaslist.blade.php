<ul class="tier2-menu vertical dropdown menu" data-dropdown-menu>
  <li>
    <div id="vue-search-form-offcanvas">
      <search-form-offcanvas>
        <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
      </search-form-offcanvas>
    </div><!-- /#vue-event-form-offcanvas -->
  </li>
    <li><a class="{{ set_active('magazine/issue', 'right-arrow')}}" href="/magazine/issue">Current Issue</a></li>
    <!-- <li><a class="{{ set_active('index', 'right-arrow')}}" href="#">Past Issues</a></li> -->
    <li><a href="http://www.emich.edu/alumni">Alumni</a></li>
    <li><a href="/hub">EMU Today</a></li>
</ul>
<ul class="tier3-menu vertical dropdown menu" data-dropdown-menu>
    <li><a href="mailto:dgiffor2@emich.edu">Subscribe to Eastern Magazine</a></li>
    <li><a href="mailto:dgiffor2@emich.edu">Submit a Story idea</a></li>
</ul>
