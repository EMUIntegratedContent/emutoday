<div id="connection-bar" class="magazine-block" data-equalizer>
  <div id="all-connections" data-equalizer-watch>
    <div id="white-bar">
      <div id="tier1-nav">
        <div class="row">
          <div class="large-9 large-push-3 medium-12 small-12 columns">
            <div class="row">
              <div class="large-5 medium-9 small-8 columns">
                <h3 class="magazine-main-title hide-for-large"><a href="/magazine">Eastern <span class="magazine-descriptor-small hide-for-large">Magazine</span></a></h3>
              </div>
              <div class="large-7 medium-3 small-4 columns">
                <div class="icon-menu float-right">

                  <div id="vue-search-form" class="hide-for-small-only">
                    <search-form>
                      <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                    </search-form>
                  </div><!-- /#vue-event-form -->

                  {{-- <span class="search-area"><a>Search <i class="fa fa-magnifying-glass"></i></a></span> --}}
                  <span class="menu-area show-for-small-only"><a data-toggle="offCanvasRight">Menu <i class="fa fa-list"></i></a></span>

                </div> <!-- .icon-menu -->
              </div>
            </div>
          </div><!-- large-9 -->
          <div class="large-3 large-pull-9 show-for-large columns">
            <div id="logo-box-magazine" data-equalizer-watch>
              <a href="/magazine"><img class="magazine-logo show-for-medium" alt="Eastern Michigan University" src="/assets/imgs/magazine/eatern-mag-logo.png"></a>
            </div><!-- logo-box-magazine -->
          </div><!-- large-3 -->


        </div><!-- row -->
      </div><!--tier1-nav -->
    </div><!-- white-bar -->
    <div id="transparent-bar">
      <div id="tier2-nav" class="magazine-menu row">
        <div class="large-10 large-push-2 medium-12 small-12 columns">
          <div class="row">
            <div class="medium-12 show-for-medium columns">
              <!-- '/admin/php/top_nav.php'); -->
              <ul id="tier2-nav-magazine">
                <li><a class="{{ set_active('magazine/issue')}}" href="/magazine/issue"><i class="fa fa-play"></i>Current Issue</a></li>
                <!-- Past Issues is a unbuild feature. Leave out for now -->
                <!-- <li><a class="{{ set_active('index')}}" href="#"><i class="fa fa-play"></i>Past Issues</a></li> -->
                {{-- <li><a class="{{ set_active('magazine/issue', 'right-arrow')}}" href="/magazine/issue">Current Issue</a></li>
                <!-- <li><a class="{{ set_active('index', 'right-arrow')}}" href="#">Past Issues</a></li> --> --}}
                <li><a href="http://www.emich.edu/alumni">Alumni</a></li>
                <li><a href="/hub">EMU Today</a></li>
              </ul>
            </div>
          </div>
        </div>
        {{-- <div class="large-2 large-pull-10 show-for-medium columns">&nbsp;</div> --}}
      </div> <!-- tier2-nav -->
    </div><!-- transparent-bar -->
    <div id="secondary-bar">
      <div id="tier3-nav" class="row">
        <div class="large-10 large-push-2 medium-12 show-for-medium columns">
          <!-- div row removed addedback-->
          <div class="row">
            <div class="large-12 medium-12 small-12 columns">
              <ul>
                <!-- '/admin/php/secondary_nav.php'); -->
                <li><a href="mailto:dgiffor2@emich.edu">Subscribe to Eastern Magazine</a></li>
                <li><a href="mailto:dgiffor2@emich.edu">Submit a Story idea</a></li>
              </ul>
            </div>
          </div>
          <!-- div row removed - addedback -->
        </div>
        <div class="large-2 large-pull-10 show-for-large columns">&nbsp;</div>
      </div>
    </div><!-- secondary-bar -->
  </div> <!-- all-connections -->
</div> <!-- connection-bar -->
