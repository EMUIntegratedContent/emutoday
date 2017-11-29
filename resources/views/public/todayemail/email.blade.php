<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

<style type="text/css" media="screen">
    body{
        font-size:16px;
        margin: 0 !important;
        padding: 0;
        background-color: #ffffff;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        font-family: 'Poppins', arial, sans-serif;;
        color: #333333;
    }
    td {
        padding: 0;
    }
    img {
        /*border: 0;*/
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
    h4{
        font-size: 18px;
    }
    h5, h6{
        font-size: 16px;
    }
    h2.moveover{padding: 12px 0 5px 6px;}
    p {
        padding: 0;
        margin: 0;
        /*margin: 4px 0 6px;*/
    }
    
    
    .indent {
        margin-left: 1.5rem;
        margin-right: 1.5rem;
    }
    
    .indent-more {
        padding-left: 35px;
        padding-right: 35px;
    }
    .img-circle {
        border-radius: 50%;
    }
    
    .outer {
        margin: 0 auto;
        width: 100%;
        max-width: 600px;
        }
    .full-width-image img {
        width: 100%;
        max-width: 600px;
        height: auto;
    }
    .inner {
    padding: 10px;
    }
   
    /*a {
        color: #ee6a56;
        text-decoration: underline;
    }*/
   

    /* One column layout */
    .one-column .contents {
        text-align: left;
    }
    .one-column p {
        font-size: 14px;
        Margin-bottom: 10px;
    }
    
    /*Two column layout*/
    .two-column {
        text-align: center;
        font-size: 0;
    }
    .two-column .column {
        width: 100%;
        max-width: 300px;
        display: inline-block;
        vertical-align: top;
    }
    .contents {
        width: 100%;
        }
    .two-column .contents {
        font-size: 14px;
            text-align: left;
        }
        .two-column img {
            width: 100%;
            max-width: 280px;
            height: auto;
        }
        .two-column .text {
            padding-top: 10px;
        }
</style>

<div style="border:0px solid #ffffff; height:auto; padding:5px; margin: 0 auto; width:100%; font-family: 'Poppins', arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" align="center" class="outer">

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
                            <h2 style="padding: 0 0 7px 0; margin-top: 0; margin-left: auto; margin-right: auto; font-size: 30px; line-height: 32px; font-weight: 600;"><span style="color: #046A38">EMU</span> Today Digest</h2>
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
                                <div style="padding-bottom: 16px; margin-bottom: 10px; border-bottom: 3px solid #97D700;">
                                    <h2><a href="{{ url('/') . '/story/' . $mainStories[0]->story_type . '/' . $mainStories[0]->id }}">{{ $mainStoryImages[0]->title }}</a></h2>
                                    <p>{!! str_limit($mainStoryImages[0]->teaser, $limit = 90, $end = '...') !!}</p>
                                </div>
                            </article>
                        </td>
                    </tr>
                    {{-- some emails might not have sub stories! --}} @if($email->mainstories->count() == 3)
                    <tr>
                        <td class="two-column">
                            <!--[if (gte mso 9)|(IE)]>
                            <table width="100%">
                            <tr>
                            <td width="50%" valign="top">
                            <![endif]-->
                            <div class="column">
                                <table width="100%">
                                        <tr>
                                            <td class="inner">
                                                <table class="contents">
                                                    <tr>
                                                        <td><img alt="{{ $mainStoryImages[1]->caption }}" src="{{ url('/') }}/imagecache/emailsub/{{$mainStoryImages[1]->filename}}" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text">
                                                                    <h3><a href="{{ url('/') . '/story/' . $mainStories[1]->story_type . '/' . $mainStories[1]->id }}">{{ $mainStoryImages[1]->title }}</a></h3>
                                                                    <p>{!! str_limit($mainStoryImages[1]->teaser, $limit = 90, $end = '...') !!}</p>
                                                            </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <!--[if (gte mso 9)|(IE)]>
                            </td><td width="50%" valign="top">
                            <![endif]-->
                            <div class="column">
                                <table width="100%">
                                        <tr>
                                            <td class="inner">
                                                <table class="contents">
                                                    <tr>
                                                            <td>
                                                                    <img alt="{{ $mainStoryImages[2]->caption }}" src="{{ url('/') }}/imagecache/emailsub/{{$mainStoryImages[2]->filename}}" />
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                            <td class="text">
                                                                   <h3><a href="{{ url('/') . '/story/' .$mainStories[2]->story_type . '/' . $mainStories[2]->id }}">{{ $mainStoryImages[2]->title }}</a></h3>
                                                                <p>{!! str_limit($mainStoryImages[2]->teaser, $limit = 90, $end = '...') !!}</p>
                                                            </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                        
                    </tr>
                    @endif
                    <tr>
                        <td valign="top" >
                    
                            <ul style="border-top: 1px solid #ccc; padding-bottom: 0px; padding-top: 22px;  margin-left: 0px; padding-left: 20px; margin-bottom: 5px;">
                                @foreach($email->stories as $story)
                                <li style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                                    <a style="text-decoration: none;" href="{{ url('/') . '/story/' . $story->story_type . '/' . $story->id }}">{{ $story->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            
                             
                            <h2 class="moveover"><a href="{{ url('/') }}/announcement">Announcements</a></h2>
                           
                            <ul style="padding-bottom: 16px; padding-top: 0px; margin-left: 0px; padding-left:20px; margin-bottom: 5px; margin-top: 5px;">
                                @foreach($email->announcements as $announcement)
                                <li style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                                    <a style="text-decoration: none; " href="{{ $announcement->link }}">{{ $announcement->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                         
                            
                        </td>
                    </tr>
                    <tr>
                        <td valign="middle">
                            <div style="border-top: 3px solid #97D700; padding-top: 5px;">
                                <h2 class="moveover"><a href="{{ url('/') }}/calendar">What's Happening at EMU</a></h2>
                                 
                                <ul style="margin-left: 0; padding-left: 5px; float: left; padding-bottom: 5px;">
                                    @foreach($email->events as $event)
                                    <li style="list-style: none; margin-left: 0; clear: both;">
                                        <div style="font-size: 18px; font-weight: 500; line-height: 110%; display: inline-block; width: 40px; height: 40px;  padding: 12px 10px 10px; float: left; text-align: center; margin-bottom: 14px; margin-right: 10px; background-color: #a2e600;">{{ $event->start_date->format('M j') }} </div>
                                        <div style="width: 75%; display: inline-block; padding-top: 5px; float: left;"><a style="text-decoration: none;" href="{{ url('/') . '/calendar/' . $event->start_date->format('Y') . '/' . $event->start_date->format('m') . '/' . $event->start_date->format('d') . '/' . $event->id }}">{{ $event->title }}</a></div>
                                    </li>
                                    @endforeach
                                </ul>
                               
                            </div>
                        </td>
                    </tr>
                    <tr style="background:#515151; color:#ffffff; border:0;">
                        
                        <td style="border:0;">
                            <table style="margin-left: auto; margin-right: auto; margin-top: 3px; margin-bottom: 3px;">
                                <tr style="text-align:center; font-size: 14px; text-transform: uppercase; border:0;">
                                  <td>
                                    <ul style="list-style: none; padding-left: 0;">
                                    <li style="display: inline-block; padding: 0;"><a style="color: #ffffff; padding-left: 0px; padding-right: 2px;  text-decoration: none;" href="https://today.emich.edu/">EMU Today</a></li>
                                    <li style="display: inline-block; padding: 0;"><a style="color: #ffffff; padding-left: 2px; padding-right: 2px; text-decoration: none;" href="https://today.emich.edu/calendar">Calendar</a></li>
                                    <li style="display: inline-block; padding: 0;"><a style="color: #ffffff; padding-left: 2px; padding-right: 2px; text-decoration: none;" href="https://today.emich.edu/announcement">Announcements</a></li>
                                    <li style="display: inline-block; padding: 0;"><a style="color: #ffffff; padding-left: 2px; padding-right: 2px; text-decoration: none;" href="https://today.emich.edu/story/news">News</a></li>
                                    <li style="display: inline-block; padding: 0;"><a style="color: #ffffff; padding-left: 2px; padding-right: 0; text-decoration: none;" href="https://today.emich.edu/magazine">Eastern Magazine</a></li>
                                    
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                            
                    </tr>
                    <tr id="footer-row" style="background:#333333; margin-top:5px; color:#ffffff; border:0;">
                        <td style="border:0;">
                            <table style="margin-left: auto; margin-right: auto; margin-bottom: 20px;">
                                <tr style="border:none;">
                                    <td valign="top" style="padding:5px; border:0;">
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
                                                <a href="http://blogemu.com/"><img class="img-circle" alt="Blog EMU" src="{{ url('/') }}/assets/imgs/icons/e-base-icons.png"></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr style="text-align:center;">
                                    <td>
                                         <ul style="list-style: none; padding-left: 0;">
                                             <li style="display: inline-block;"><a style="color: #ffffff; padding-left: 0; padding-right: 3px; text-decoration: none;" href="https://www.emich.edu/communications/">Division of Communications</a></li>
                                             <li style="display: inline-block; color: #ffffff;"> | </li>
                                           <li style="display: inline-block;"> <a style="color: #ffffff; padding-left: 0; padding-left: 3px; text-decoration: none;" href="https://www.emich.edu">Eastern Michigan University</a></li>
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