<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

<style type="text/css" media="screen">
    body{
        font-size: .9rem;
        line-height: 1.3rem;
        margin: 0 !important;
        padding: 0;
        background-color: #e1e1e1;
        color: #636363;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        font-family: 'Poppins', arial, sans-serif;;
        color: #333333;
        background-color: #ffffff;
    }
    td {
        padding: 0;
    }
    img {

    }
    div[style*="margin: 16px 0"] {
        margin:0 !important;
    }
    .wrapper {
        width: 100%;
        table-layout: fixed;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    .webkit {
        max-width: 600px;
        margin: 0 auto;
    }

    a {
        color: #046A38;
        text-decoration: underline;
    }

    a:visited {
        color: #046A38;
        text-decoration: none;
    }

    a:hover {
        color: #2b873b;
        text-decoration: underline;
    }

    a:active {
        color: #046A38;
        text-decoration: underline;
    }
    a.uppertitle{
        text-decoration: none;
        color: #333333;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 500;
        padding: 12px 0 3px;
        margin: 0;
    }
    .h1 {
        font-size: 24px;

    }
    h2{
        font-size: 22px;

    }
    h3{
        font-size: 20px;
    }
    h3.mid{
        font-size: 18px;
        padding: 12px 0 8px;
        line-height: 22px;
        text-decoration: none;
    }
    h3.mid a{
        text-decoration: none;
    }

    h4{
        font-size: 18px;
    }
    h5, h6{
        font-size: 16px;
    }
    h2.moveover{padding: 14px 0 6px 8px; margin-top: 0rem; text-decoration: none;}

    h3.moveover{padding: 10px 0 6px 8px; margin-top: 0rem; text-decoration: none; font-size: 18px;}

    h2 a{text-decoration: none; color: #636363;}
    h3 a{text-decoration: none; color: #636363;}
    p {
        padding: 0;
        margin: 0;
    }
    p.direct-today-link {
        text-align: center;
        font-size: 12px;
        margin-bottom: 8px;
        padding-top: 5px;
    }
    p.sub-title {
        margin-bottom: 10px;
    }

    .indent {
        margin-left: 1rem;
        margin-right: 1rem;
    }
    .indent-less {
        /*margin-left: .5rem;
        margin-right: .5rem;*/
        margin-left: 1rem;
        margin-right: 1rem;
    }
    .indent-more {
        padding-left: 35px;
        padding-right: 35px;
    }
    .img-circle {
        border-radius: 50%;
    }

/*from others*/
    .outer {
        margin: 0 auto;
        width: 98%;
        max-width: 600px;
        }
    .full-width-image img {
        width: 100%;
        max-width: 600px;
        height: auto;
       
    }
    .inner {
        padding-top: 0px;
         padding-bottom: 10px;
         padding-left: 10px;
         padding-right: 10px;
    }
    .one-column p {
        font-size: .9rem;
        line-height: 1.3rem;
        Margin-bottom: 10px;
    }
    /*Two column layout*/
     img.col-img{
          max-width: 100% !important;
            /*width: 100%  !important;*/
            position: relative;
        }
    /*Card version*/
    
    .card-container {
        margin-left: .8rem; margin-right: .8rem; margin-top:10px; padding: 0; float: left; position: relative; max-width: 100%; box-sizing: border-box; background-color: blue;
    }
    .card-container .card{
        margin-left: 0; width: 46%; margin-right: 4%;  float: left; position: relative; box-sizing: border-box; display: inline-block; max-width: 100%; background-color: pink;
    }
    
     .card-container .card.right-card{
        margin-left: 0; width: 46%; margin-right: 0; float: right; position: relative; box-sizing: border-box; display: inline-block; max-width: 100%;background-color: orange;
    }
    
    
    
    
    
    /*Two column*/
    /*.two-column {
        text-align: center;
        font-size: 0;
        position: relative;
        box-sizing: border-box;
        margin-left: 0rem;
        margin-right: 0rem;
        display: block;
        
    }
    .two-column .column {
        width: 48%; box-sizing: border-box; position: relative; display: inline-block;
    }
    .contents {
        }
    .two-column .contents {
        font-size: 14px;
        text-align: left;
        margin-bottom: .3rem;
        }
   
    .two-column .column .text {
            padding-top: 0px;
        }*/

    
    /*Media Queries*/
@media only screen and (min-width: 610px) {
    
       
    /*.two-column {
        width: 560px;
    }
     img.col-img{
            display:none !important;
        }*/

    }

@media only screen and (min-width: 480px) and (max-width: 609px) {
   
   /* tr.two-images-up table{
         width: 300px;
        display:none !important;
    }*/
    /*.two-column {
        display:none !important;
        text-align: center;
        font-size: 0;
        width: 440px;
        position: relative;
        box-sizing: border-box;
        margin-left: 0rem;
        margin-right: 0rem;
        display: block;
    }
    .two-column .column {
        display:none !important;
        width: 40%; 
        box-sizing: border-box; 
        position: relative; 
        display: inline-block;"
    }*/
   

}
  @media only screen and (max-width: 480px){
    
      div[class="card-container"]  {
        display: none;
        height: 0;
          width:0;
          max-width: 0;
    }
    .inner h3{
        padding-top: 0px;
        padding-bottom: 0px;
    }
    }
</style>

<div style="border:0px solid #ffffff; height:auto; padding:5px; margin: 0 auto; width:96%; font-family: 'Poppins', arial, sans-serif;">
    <p class="direct-today-link"><a href="{{ url('/') }}">Read EMU Today online</a></p>
    <table border="0" cellpadding="0" cellspacing="0" height="100%" align="center" class="outer" style="padding-top: .3rem;">
        <tr>
            <td align="center" valign="top">
                <table border="0" style="max-width: 100%;" id="emailContainer">
                    <tr height="54px">
                        <td class="full-width-image">
                            <a href="http://www.emich.edu/" style="margin: 0; padding: 0;"><img src="{{ url('/') }}/assets/imgs/email/topsection.png" alt="EMU Today email blast logo" /></a>
                        </td>
                    </tr>
                    <tr valign="top" id="header-row" style="text-align:center">
                        <td>
                            <h2 style="padding: 0 0 7px 0; margin-top: 0; margin-left: auto; margin-right: auto; font-size: 38px; line-height: 38px; font-weight: 500;">The Week at EMU</h2>
                            <p class="sub-title">A Weekly Digest from <a class="uppertitle" href="{{ url('/') }}"><span style="color: #046A38">EMU</span> Today </a></p>
                        </td>
                    </tr>
                    {{--
                    <tr valign="top" id="title-row" style="padding: 0; margin: 0;">
                        <td style="text-align:center">
                            <header>
                                <h2>{{ $email->title }}</h2>
                                <p>{{ $email->subheading }}</p>
                            </header>
                        </td>
                    </tr>
                    --}}
                    <tr>
                        <td valign="top" class="full-width-image">
                            <article>
                                <img alt="{{ $mainStoryImages[0]->caption }}" src="{{ url('/') }}/imagecache/emailmain/{{$mainStoryImages[0]->filename}}" style="border-right:0px solid #ffffff; max-width:600px;  border-top: 3px solid #97D700;" />
                                <div style="padding-left: 1rem; padding-right: 1rem; padding-top: .6rem; padding-bottom: 16px; margin-bottom: 10px;">
                                    <h2 class="indent" style="margin-bottom: .8rem;"><a href="{{ url('/') . '/story/' . $mainStories[0]->story_type . '/' . $mainStories[0]->id }}">{{ $mainStoryImages[0]->title }} &#10137;</a></h2>
                                    {{--<p class="indent">{!! str_limit($mainStoryImages[0]->teaser, $limit = 130, $end = '...') !!}</p>--}}
                                    <p class="indent">{!! truncateLimitWords($mainStoryImages[0]->teaser, 130) !!}</p>
                                </div>
                            </article>
                        </td>
                    </tr>
                    {{-- some emails might not have sub stories! --}}
                    @if($email->mainstories->count() == 3)
                   
                    @endif
                 
                         
                    
                    
                    <!--test2-->
                         <tr>
                        <td valign="top">
                            <div class="indent" >
                                
                                    <!--<div class="card-container" style="margin-left: .8rem; margin-right: .8rem; margin-top:10px; padding: 0; float: left; position: relative; max-width: 100%; box-sizing: border-box;">-->
                                        <div class="card-container">
                                    
                                        <!--<div class="card" style="margin-left: 0; width: 47%; margin-right: 6%;  float: left; position: relative; box-sizing: border-box; display: inline-block; max-width: 100%;">-->
                                            <div class="card">

                                            <div class="imagebox" style="margin-bottom: 0px; color: #ffffff; text-decoration: none;"><img class="col-img" alt="{{ $mainStoryImages[1]->caption }}" src="{{ url('/') }}/imagecache/emailsub/{{$smallStoryImages[1]->filename}}" /></div>

                                            <div class="text-box" style="padding-top: 5px; padding-bottom: 10px; float: left; position: relative; box-sizing: border-box;">
                                                 <h3 class="mid"><a href="{{ url('/') . '/story/' . $mainStories[1]->story_type . '/' . $mainStories[1]->id }}">{{ $mainStoryImages[1]->title }} &#10137;</a></h3>
                                                                                    {{--<p>{!! str_limit($mainStoryImages[1]->teaser, $limit = 110, $end = '...') !!}</p>--}}
                                                                                    {!! truncateLimitWords($mainStoryImages[1]->teaser, 110) !!}
                                                </div>

                                        </div>
                                  
                                       <!-- <div class="card right-card" style="margin-left: 0; width: 47%;  float: right; position: relative; box-sizing: border-box; display: inline-block; max-width: 100%;">-->
                                            <div class="card right-card">

                                            <div class="imagebox" style="margin-bottom: 0px; color: #ffffff; text-decoration: none;"><img  class="col-img" alt="{{ $mainStoryImages[2]->caption }}" src="{{ url('/') }}/imagecache/emailsub/{{$smallStoryImages[2]->filename}}" /></div>

                                            <div class="text-box" style="padding-top: 5px; padding-bottom: 10px; float: left; position: relative; box-sizing: border-box;">
                                                <h3 class="mid"><a href="{{ url('/') . '/story/' .$mainStories[2]->story_type . '/' . $mainStories[2]->id }}">{{ $mainStoryImages[2]->title }} &#10137;</a></h3>
                                                                                   {{--<p>{!! str_limit($mainStoryImages[2]->teaser, $limit = 110, $end = '...') !!}</p>--}}
                                                                                   {!! truncateLimitWords($mainStoryImages[2]->teaser, 110) !!}</div>

                                        </div>
                                   
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    
                    
                    
                    
                    
                     <tr>
                        <td valign="top" >

                            <div class="indent">
                            <h3 class="moveover"><a href="{{ url('/') }}/story/news">More News &#10137;</a></h3>
                            <ul style="padding-bottom: 8px; padding-top: 0px;  margin-left: 0px; padding-left: 24px; margin-bottom: 5px; margin-top: 5px;" >
                                @foreach($email->stories()->get() as $story)
                                <li style="padding-bottom: 9px; margin-left: 0; color:#046A38;">
                                    @if($story->story_type == 'external')
                                      {{-- External stories should go directly to the external link, which is located in the "link" field of the story's external_small image --}}
                                      <a style="text-decoration: none;" href="{{$story->getExternalLink()}}">{{ $story->title }}</a>
                                    @else
                                      <a style="text-decoration: none;" href="{{ url('/') . '/story/' . $story->story_type . '/' . $story->id }}">{{ $story->title }}</a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div class="indent" >
                                <h2 class="moveover" style="border-top: 3px double #97D700;"><a href="{{ url('/') }}/announcement">Announcements &#10137;</a></h2>
                                <ul style="padding-bottom: 8px; padding-top: 0px; margin-left: 0px; padding-left:24px; margin-bottom: 5px; margin-top: 5px;">
                                    @foreach($email->announcements()->get() as $announcement)
                                    <li style="padding-bottom: 9px; margin-left: 0; color:#046A38;">
                                      @if($announcement->link != '')
                                        <a style="text-decoration: none; " href="{{ $announcement->link }}">{{ $announcement->title }}</a>
                                      @else
                                        <a style="text-decoration: none; " href="{{ url('/') . '/announcement/' . $announcement->id }}">{{ $announcement->title }}</a>
                                      @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="middle">
                            <div class="indent" >
                                <h2 class="moveover" style="border-top: 3px double #97D700;"><a href="{{ url('/') }}/calendar">What's Happening at EMU &#10137;</a></h2>
                                <ul style="margin-left: 0; margin-top:10px; padding-left: 7px; float: left; padding-bottom: 5px;">
                                    @foreach($email->events()->get() as $event)
                                    <li style="list-style: none; margin-left: 0; clear: both;">
                                        <div style="font-size: 18px; font-weight: 500; line-height: 110%; display: inline-block; width: 40px; height: 40px;  padding: 8px 10px 10px; float: left; text-align: center; margin-bottom: 14px; margin-right: 10px; color: #ffffff; background-color: #2b873b; text-decoration: none;">{{ $event->start_date->format('M j') }} </div>
                                        <div style="width: 75%; display: inline-block; padding-top: 5px; padding-bottom: 10px; float: left;"><a style="text-decoration: none;" href="{{ url('/') . '/calendar/' . $event->start_date->format('Y') . '/' . $event->start_date->format('m') . '/' . $event->start_date->format('d') . '/' . $event->id }}">{{ $event->title }}</a></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr style="background:#515151; color:#ffffff; border:0;">
                        <td style="border:0; ">
                            <table style="margin-left: auto; margin-right: auto; margin-top: 3px; margin-bottom: 3px;">
                                <tr style="text-align:center; font-size: 12px; text-transform: uppercase; border:0; background-color:#515151; color:#ffffff;">
                                  <td>
                                    <ul style="list-style: none; padding-left: 0; background:#515151; color:#ffffff;">

                                    <li style="display: inline-block; padding: 0; margin: 0;"><a style="color: #ffffff; padding-left: 0px; padding-right: 5px;  text-decoration: none;" href="{{ url('/') }}">EMU Today</a></li>
                                    <li style="display: inline-block; padding: 0; margin: 0;"><a style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;" href="{{ url('/') }}/calendar">Calendar</a></li>
                                    <li style="display: inline-block; padding: 0; margin: 0;"><a style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;" href="{{ url('/') }}/announcement">Announcements</a></li>
                                    <li style="display: inline-block; padding: 0; margin: 0;"><a style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;" href="{{ url('/') }}/story/news">News</a></li>
                                    <li style="display: inline-block; padding: 0; margin: 0;"><a style="color: #ffffff; padding-left: 5px; padding-right: 0; text-decoration: none;" href="{{ url('/') }}/magazine">Eastern Magazine</a></li>


                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr id="footer-row" style="background-color: #333333; margin-top: 5px; color: #ffffff; border:0;">
                        <td style="border:0; background-color: #333333; color: #ffffff;">
                            <table style="margin-left: auto; margin-right: auto; margin-bottom: 20px;  background-color: #333333; color: #ffffff;">
                                <tr style="border:none; background-color: #333333; color: #ffffff;">
                                    <td valign="top" style="padding:5px; border:0; background-color: #333333; color: #ffffff;">
                                        <ul style="padding-left: 5px; text-align:center; padding-bottom: 0px; margin-bottom: 0;">
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                                                <a href="https://www.facebook.com/EasternMichU/"><img class="img-circle" alt="Facebook" src="{{ url('/') }}/assets/imgs/icons/facebook-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                                                <a href="http://www.emich.edu/twitter/"><img class="img-circle" alt="Twitter" src="{{ url('/') }}/assets/imgs/icons/twitter-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                                                <a href="https://www.youtube.com/user/emichigan08"><img class="img-circle" alt="YouTube" src="{{ url('/') }}/assets/imgs/icons/you-tube-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                                                <a href="https://instagram.com/easternmichigan/"><img class="img-circle" alt="Instagram" src="{{ url('/') }}/assets/imgs/icons/instagram-base-icons-new.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                                                <a href="https://www.linkedin.com/edu/school?id=18604"><img class="img-circle" alt="Linked-In" src="{{ url('/') }}/assets/imgs/icons/linked-in-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                                                <a href="https://www.snapchat.com/add/EasternMichigan"><img class="img-circle" alt="Snap Chat" src="{{ url('/') }}/assets/imgs/icons/snapchat.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                                                <a href="http://blogemu.com/"><img class="img-circle" alt="Blog EMU" src="{{ url('/') }}/assets/imgs/icons/e-base-icons.png"></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr style="text-align:center;">
                                    <td>
                                         <ul style="list-style: none; padding-left: 0;">
                                             <li style="display: inline-block;"><a style="font-size: 13px; color: #ffffff; padding-left: 0; padding-right: 3px; text-decoration: none;" href="https://www.emich.edu/communications/">Division of Communications</a></li>
                                             <li style="font-size: 13px; display: inline-block; color: #ffffff;"> | </li>
                                           <li style="display: inline-block;"> <a style="font-size: 13px; color: #ffffff; padding-left: 0; padding-left: 3px; text-decoration: none;" href="https://www.emich.edu">Eastern Michigan University</a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
