<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700" rel="stylesheet">

<style type="text/css" media="screen">
    body{
        font-size:16px;
    }
    table {
    border-collapse: collapse;
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
        padding: 12px 0 5px;
        margin: 0;
    }
 
    p {
        padding: 0;
        margin: 4px 0 6px;
    }
    
    .indent {
        margin-left: 1.5rem;
        margin-right: 1.5rem;
    }
    
    .indent-more {
        padding-left: 40px;
        padding-right: 40px;
    }
    .img-circle {
        border-radius: 50%;
    }
    
</style>

<div style="border:1px solid #000000; padding:5px; margin: 0 auto; width:610px; font-family: 'Poppins', arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">

        <tr>
            <td align="center" valign="top">
                <table border="0" width="600" id="emailContainer">
                    <tr height="54px">
                        <td style="padding-bottom: 0; margin-bottom 0; position: relative;" colspan="2" height="54px">
                            <a href="http://www.emich.edu/" style="margin: 0; padding: 0;"><img width="600px" style="padding: 0; margin: 0; position: relative;" src="{{ url('/') }}/assets/imgs/email/topsection.png" alt="EMU Today email blast logo" /></a>
                        </td>

                    </tr>
                    <tr valign="top" id="header-row" style="text-align:center">
                        <td colspan="2">
                            <h2 style="padding: 0 0 5px 0; margin-top: 0; margin-left: auto; margin-right: auto; font-size: 30px; line-height: 34px; font-weight: 600;"><span style="color: #046A38">EMU</span> Today Digest</h2>
                        </td>
                    </tr>
                    {{--
                    <tr valign="top" id="title-row" style="padding: 0; margin: 0;">
                        <td colspan="2" style="text-align:center">
                            <header>
                                <h2>{{ $email->title }}</h2>
                                <p>{{ $email->subheading }}</p>
                            </header>
                        </td>
                    </tr>
                    --}}
                    <tr>
                        <td valign="top">
                            <article>
                                <img alt="{{ $mainStoryImages[0]->caption }}" src="{{ url('/') }}/imagecache/emailmain/{{$mainStoryImages[0]->filename}}" style="border-right:0px solid #ffffff; width:600px; height:282px; border-top: 3px solid #97D700;" />
                                <div class="indent" style="padding-bottom: 16px; margin: 0; border-bottom: 3px solid #97D700;">
                                    <h2><a href="{{ url('/') . '/story/' . $mainStories[0]->story_type . '/' . $mainStories[0]->id }}">{{ $mainStoryImages[0]->title }}</a></h2>
                                    <p>{!! str_limit($mainStoryImages[0]->teaser, $limit = 90, $end = '...') !!}</p>
                                </div>
                            </article>
                        </td>
                    </tr>
                    {{-- some emails might not have sub stories! --}} @if($email->mainstories->count() == 3)
                    <tr>
                        <table>
                             
                            <tr >
                                <td valign="top" width="40px">&nbsp;</td>
                                <td colspan="2">
                                  
                                    <h2><a href="{{ url('/') }}/story/news">News Stories</a></h2> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" width="40px">&nbsp;</td>
                               
                                <td valign="top" width="250px">
                                     
                                    <article>
                                        <img alt="{{ $mainStoryImages[1]->caption }}" src="{{ url('/') }}/imagecache/emailsub/{{$mainStoryImages[1]->filename}}" style="padding: 0; margin: 0; border-right:0px solid #ffffff; width:100%; height:auto;" />
                                        <h3><a href="{{ url('/') . '/story/' . $mainStories[1]->story_type . '/' . $mainStories[1]->id }}">{{ $mainStoryImages[1]->title }}</a></h3>
                                        <p>{!! str_limit($mainStoryImages[1]->teaser, $limit = 90, $end = '...') !!}</p>
                                    </article>
                                   
                                </td>
                                 <td valign="top" width="20px">&nbsp;</td>
                                <td valign="top" width="250px">
                                    <article>
                                        <img alt="{{ $mainStoryImages[2]->caption }}" src="{{ url('/') }}/imagecache/emailsub/{{$mainStoryImages[2]->filename}}" style="border-right:0px solid #ffffff; width:100%; height:auto;" />
                                        <h3><a href="{{ url('/') . '/story/' .$mainStories[2]->story_type . '/' . $mainStories[2]->id }}">{{ $mainStoryImages[2]->title }}</a></h3>
                                        <p>{!! str_limit($mainStoryImages[2]->teaser, $limit = 90, $end = '...') !!}</p>
                                    </article>
                                </td>
                                 <td valign="top" width="40px">&nbsp;</td>
                              
                            </tr>
                                 
                        </table>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="2" valign="top" >
                            <div class="indent-more">   
                            <ul style="border-top: 1px solid #ccc; padding-bottom: 0px; padding-top: 22px;  margin-left: 0px; padding-left: 20px; margin-bottom: 5px;">
                                @foreach($email->stories as $story)
                                <li style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                                    <a style="text-decoration: none;" href="{{ url('/') . '/story/' . $story->story_type . '/' . $story->id }}">{{ $story->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" valign="top" style="padding-bottom: 16px;">
                            <div class="indent-more">   
                             
                            <h2><a href="{{ url('/') }}/announcement">Announcements</a></h2>
                           
                            <ul style="padding-bottom: 0px; padding-top: 0px; margin-left: 0px; padding-left:20px; margin-bottom: 5px; margin-top: 5px;">
                                @foreach($email->announcements as $announcement)
                                <li style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                                    <a style="text-decoration: none; " href="{{ $announcement->link }}">{{ $announcement->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                            </div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" valign="top" style="padding-bottom: 18px;  border:0;">
                            <div class="indent" style="border-top: 3px solid #97D700; padding-top: 8px;">
                                <h2><a href="{{ url('/') }}/calendar">What's Happening at EMU</a></h2>
                                <ul style="margin-left: 0; padding-left: 0;">
                                    @foreach($email->events as $event)
                                    <li style="list-style: none; margin-left: 0;">
                                        <div style="width: 12%; display: inline-block; float: left;">{{ $event->start_date->format('M j') }} </div>
                                        <div style="width: 88%; display: inline-block; padding-bottom: 10px; float: left;"><a style="text-decoration: none;" href="{{ url('/') . '/calendar/' . $event->start_date->format('Y') . '/' . $event->start_date->format('m') . '/' . $event->start_date->format('d') . '/' . $event->id }}">{{ $event->title }}</a></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr style="background:#515151; margin-top:5px; color:#ffffff; border:0;">
                        <td style="padding-top:6px; padding-bottom: 6px; border:0;">
                            <table style="margin-left: auto; margin-right: auto; padding-top: 14px; padding-bottom: 14px;">
                                <tr style="text-align:center; font-size: 15px; text-transform: uppercase; border:0;">
                                    <td><a style="color: #ffffff; padding-left: 0; padding-right: 5px; text-decoration: none;" href="https://today.emich.edu/">EMU Today</a></td>
                                    <td><a style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;" href="https://today.emich.edu/calendar">Calendar</a></td>
                                    <td><a style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;" href="https://today.emich.edu/announcement">Announcements</a></td>
                                    <td><a style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;" href="https://today.emich.edu/story/news">News</a></td>
                                    <td><a style="color: #ffffff; padding-left: 5px; padding-right: 0; text-decoration: none;" href="https://today.emich.edu/magazine">Eastern Magazine</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr id="footer-row" style="background:#333333; margin-top:5px; color:#ffffff; border:0;">
                        <td colspan="2" style="border:0;">
                            <table style="margin-left: auto; margin-right: auto;">
                                <tr style="border:none;">
                                    <td valign="top" style="padding:5px; border:0;">
                                        <ul style="padding-left: 5px; text-align:center; padding-bottom: 0px; margin-bottom: 0;">
                                            <li style="display: inline-block; list-style-type:none; padding-right:10px;">
                                                <a href="https://www.facebook.com/EasternMichU/"><img class="img-circle" alt="Facebook" src="{{ url('/') }}/assets/imgs/icons/facebook-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:10px;">
                                                <a href="http://www.emich.edu/twitter/"><img class="img-circle" alt="Twitter" src="{{ url('/') }}/assets/imgs/icons/twitter-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:10px;">
                                                <a href="https://www.youtube.com/user/emichigan08"><img class="img-circle" alt="YouTube" src="{{ url('/') }}/assets/imgs/icons/you-tube-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:10px;">
                                                <a href="https://instagram.com/easternmichigan/"><img class="img-circle" alt="Instagram" src="{{ url('/') }}/assets/imgs/icons/instagram-base-icons-new.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:10px;">
                                                <a href="https://www.linkedin.com/edu/school?id=18604"><img class="img-circle" alt="Linked-In" src="{{ url('/') }}/assets/imgs/icons/linked-in-base-icons.png"></a>
                                            </li>
                                            <li style="display: inline-block; list-style-type:none; padding-right:10px;">
                                                <a href="http://blogemu.com/"><img class="img-circle" alt="Blog EMU" src="{{ url('/') }}/assets/imgs/icons/e-base-icons.png"></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <p><a style="color: #ffffff; padding-left: 0; padding-right: 3px; text-decoration: none;" href="https://www.emich.edu/communications/">Division of Communications</a> | <a style="color: #ffffff; padding-left: 0; padding-right: 3px; text-decoration: none;" href="https://www.emich.edu">Eastern Michigan University</a></p>
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