<template>
  <section id="email-live-container" style="margin:0 auto; width:620px; border:1px solid #d1d1d1; margin-bottom:20px">
    <div
        style="border:0px solid #ffffff; height:auto; padding:5px; margin: 0 auto; width:100%; font-family: 'Poppins', arial, sans-serif;">
      <table border="0" cellpadding="0" cellspacing="0" height="100%" align="center" class="outer">

        <tr>
          <td align="center" valign="top">
            <table border="0" style="max-width: 100%;" id="emailContainer">
              <tr height="54px">
                <td class="full-width-image">
                  <a href="http://www.emich.edu/" style="margin: 0; padding: 0;"><img
                      src="/assets/imgs/email/topsection.png" alt="EMU Today email blast logo"/></a>
                </td>
              </tr>

              <tr valign="top" id="header-row" style="text-align:center">
                <td>
                  <h2 style="padding: 0 0 7px 0; margin-top: 0; margin-left: auto; margin-right: auto; font-size: 38px; line-height: 38px; font-weight: 500;">
                    The Week at EMU</h2>
                  <p class="sub-title">A Weekly Digest from <a class="uppertitle" href="/"><span style="color: #046A38">EMU</span>
                    Today </a></p>
                </td>
              </tr>

              <tr>
                <td valign="top" class="full-width-image">
                  <template v-if="emailBuilderEmail.mainStories[0]">
                    <article>
                      <template v-if="emailBuilderEmail.mainStories[0].story_type === 'Inside EMU'">
                        <img :alt="emailBuilderEmail.mainStories[0].email_images[0].caption"
                             :src="emailBuilderEmail.mainStories[0].email_images[0].image_path"
                             style="border-right:0px solid #ffffff; max-width:600px;  border-top: 3px solid #97D700;"/>
                      </template>
                      <template v-else>
                        <img :alt="emailBuilderEmail.mainStories[0].email_images[0].caption"
                             :src="emailBuilderEmail.mainStories[0].email_images[0].image_path + emailBuilderEmail.mainStories[0].email_images[0].filename"
                             style="border-right:0px solid #ffffff; max-width:600px;  border-top: 3px solid #97D700;"/>
                      </template>
                      <div class="indent" style="padding-bottom: 16px; margin-bottom: 10px;">
                        <h2>
                          <a v-if="emailBuilderEmail.mainStories[0].story_type == 'external' || (emailBuilderEmail.mainStories[0].story_type == 'article' && storyHasTag(emailBuilderEmail.mainStories[0], 'external'))"
                             style="text-decoration: none;"
                             :href="emailBuilderEmail.mainStories[0].small_images[0].link">{{
                              emailBuilderEmail.mainStories[0].email_images[0].title
                            }} &#10137;</a>
                          <a v-else :href="emailBuilderEmail.mainStories[0].full_url">{{
                              emailBuilderEmail.mainStories[0].email_images[0].title
                            }} &#10137;</a>
                        </h2>
                        {{ truncate(emailBuilderEmail.mainStories[0].email_images[0].teaser, '135') }}
                      </div>
                    </article>
                  </template>
                  <template v-else>
                    <div
                        style="background-color:#e5e5e5; position:relative; width:600px; height:282px; text-align:center; margin:0 auto; border-right:5px solid #ffffff;">
                      <p style="position:absolute; left:143px; top:121px; font-size:3rem;">Main story image here.</p>
                    </div>
                    <h2 style="padding:0 5px" class="insufficient">No main story set yet.</h2>
                    <p style="padding:0 5px">Select a main story from the "Main Story" tab.</p>
                  </template>
                </td>
              </tr>
              <!-- some emails might not have sub stories! -->
              <template v-if="emailBuilderEmail.mainStories.length == 3">
                <tr>
                  <td>
                    <table>
                      <tr>
                        <td class="two-column">
                          <div class="column">
                            <table>
                              <tr>
                                <td class="inner">
                                  <template v-if="emailBuilderEmail.mainStories[1]">
                                    <table class="contents">
                                      <tr>
                                        <!-- -->
                                        <td style="text-align:left;">
                                          <template v-if="emailBuilderEmail.mainStories[1].story_type === 'Inside EMU'">
                                            <img class="col-img"
                                                 :alt="emailBuilderEmail.mainStories[1].small_images[0].caption"
                                                 :src="emailBuilderEmail.mainStories[1].small_images[0].image_path"/>
                                          </template>
                                          <template v-else>
                                            <img class="col-img"
                                                 :alt="emailBuilderEmail.mainStories[1].small_images[0].caption"
                                                 :src="emailBuilderEmail.mainStories[1].small_images[0].image_path + emailBuilderEmail.mainStories[1].small_images[0].filename"/>
                                          </template>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text" style="text-align:left;">
                                          <h3>
                                            <a v-if="emailBuilderEmail.mainStories[1].story_type == 'external' || (emailBuilderEmail.mainStories[1].story_type == 'article' && storyHasTag(emailBuilderEmail.mainStories[1], 'external'))"
                                               style="text-decoration: none;"
                                               :href="emailBuilderEmail.mainStories[1].small_images[0].link">{{
                                                emailBuilderEmail.mainStories[1].email_images[0].title
                                              }} &#10137;</a>
                                            <a v-else style="text-decoration: none;"
                                               :href="emailBuilderEmail.mainStories[1].full_url">{{
                                                emailBuilderEmail.mainStories[1].email_images[0].title
                                              }} &#10137;</a>
                                          </h3>
                                          <p>{{
                                              truncate(emailBuilderEmail.mainStories[1].email_images[0].teaser, '110')
                                            }}</p>
                                        </td>
                                      </tr>
                                    </table>
                                  </template>
                                  <template v-else>
                                    <div
                                        style="background-color:#e5e5e5; text-align:center; margin:0 auto; border-right:5px solid #ffffff; width:231px; height:210px;">
                                      <p style="font-size:3rem;">First sub story image here.</p>
                                    </div>
                                    <h3 style="padding:0 5px" class="insufficient">No first sub story set yet.</h3>
                                    <p style="padding:0 5px">Select a first sub story from the "Main Story" tab.</p>
                                  </template>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div class="column">
                            <table>
                              <tr>
                                <td class="inner">
                                  <template v-if="emailBuilderEmail.mainStories[2]">
                                    <table class="contents">
                                      <tr>
                                        <td>
                                          <template v-if="emailBuilderEmail.mainStories[2].story_type === 'Inside EMU'">
                                            <img class="col-img"
                                                 :alt="emailBuilderEmail.mainStories[2].small_images[0].caption"
                                                 :src="emailBuilderEmail.mainStories[2].small_images[0].image_path"/>
                                          </template>
                                          <template v-else>
                                            <img class="col-img"
                                                 :alt="emailBuilderEmail.mainStories[2].small_images[0].caption"
                                                 :src="emailBuilderEmail.mainStories[2].small_images[0].image_path + emailBuilderEmail.mainStories[2].small_images[0].filename"/>
                                          </template>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="text">
                                          <h3>
                                            <a v-if="emailBuilderEmail.mainStories[2].story_type == 'external' || (emailBuilderEmail.mainStories[2].story_type == 'article' && storyHasTag(emailBuilderEmail.mainStories[2], 'external'))"
                                               style="text-decoration: none;"
                                               :href="emailBuilderEmail.mainStories[2].small_images[0].link">{{
                                                emailBuilderEmail.mainStories[2].email_images[0].title
                                              }} &#10137;</a>
                                            <a v-else style="text-decoration: none;"
                                               :href="emailBuilderEmail.mainStories[2].full_url">{{
                                                emailBuilderEmail.mainStories[2].email_images[0].title
                                              }} &#10137;</a>
                                          </h3>
                                          <p>{{
                                              truncate(emailBuilderEmail.mainStories[2].email_images[0].teaser, '110')
                                            }}</p>
                                        </td>
                                      </tr>
                                    </table>
                                  </template>
                                  <template v-else>
                                    <div
                                        style="background-color:#e5e5e5; text-align:center; margin:0 auto; border-right:5px solid #ffffff; width:231px; height:210px;">
                                      <p style="font-size:3rem;">First sub story image here.</p>
                                    </div>
                                    <h3 style="padding:0 5px" class="insufficient">No first sub story set yet.</h3>
                                    <p style="padding:0 5px">Select a first sub story from the "Main Story" tab.</p>
                                  </template>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </template>
              <tr>
                <td valign="top">
                  <div>
                    <h2 class="moveover"><a href="/story/news">More News &#10137;</a></h2>
                    <template v-if="emailBuilderEmail.otherStories.length > 0">
                      <ul style="padding-bottom: 0px; margin-left: 0px; padding-left: 24px; margin-bottom: 5px;">
                        <li v-for="story in emailBuilderEmail.otherStories"
                            style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                          <a v-if="story.story_type == 'external' || (story.story_type == 'article' && storyHasTag(story, 'external'))"
                             style="text-decoration: none;" :href="story.small_images[0].link">{{ story.title }}</a>
                          <a v-else style="text-decoration: none;" :href="story.full_url">{{ story.title }}</a>
                        </li>
                      </ul>
                    </template>
                    <template v-else>
                      <p style="padding:0 5px" class="insufficient">No side stories set yet. Select at least one from
                        the "Side Stories" tab.</p>
                    </template>
                  </div>
                </td>
              </tr>
              <tr v-if="emailBuilderEmail.is_emu175_included">
                <td valign="top" style="border-top: 3px double #97D700; min-height:136px; padding:15px">
                  <img src="/assets/imgs/emu175/emu-175-white-logo-no-date.png" alt="EMU's logo celebrating 175 years."
                       style="float:left; padding:0 15px 8px 0; width:109px"/>
                  <h2 style="padding-top:0px;">
                    <template v-if="emailBuilderEmail.emu175_url">
                      <a v-if="emailBuilderEmail.emu175_url" :href="emailBuilderEmail.emu175_url">Celebrating EMU's
                        175th Anniversary &#10137;</a>
                    </template>
                    <template v-else>
                      <span class="insufficient">Celebrating EMU 175th Anniversary [NO URL]</span>
                    </template>
                  </h2>
                  <template v-if="emailBuilderEmail.emu175_teaser">
                    <p style="font-size:1.1rem;">{{ emailBuilderEmail.emu175_teaser }}</p>
                  </template>
                  <template v-else>
                    <p style="font-size:1.1rem;" class="insufficient">There is no teaser text provided. You must include
                      this text when including an EMU 175 link.</p>
                  </template>
                </td>
              </tr>
              <tr v-if="emailBuilderEmail.is_president_included">
                <td valign="top" style="border-top: 3px double #97D700; min-height:136px; padding:15px">
                  <img src="/assets/imgs/email/president-jim-smith-2024-109x136.png" alt="EMU President Jim Smith"
                       style="float:left; padding:0 15px 8px 0; width:109px"/>
                  <h2 style="padding-top:0px;">
                    <template v-if="emailBuilderEmail.president_url">
                      <a v-if="emailBuilderEmail.president_url" :href="emailBuilderEmail.president_url">From the
                        President &#10137;</a>
                    </template>
                    <template v-else>
                      <span class="insufficient">From the President [NO URL]</span>
                    </template>
                  </h2>
                  <template v-if="emailBuilderEmail.president_teaser">
                    <p style="font-size:1.1rem;">{{ emailBuilderEmail.president_teaser }}</p>
                  </template>
                  <template v-else>
                    <p style="font-size:1.1rem;" class="insufficient">There is no teaser text provided. You must include
                      this text when including a presidential message.</p>
                  </template>
                </td>
              </tr>
              <tr v-if="!emailBuilderEmail.exclude_insideemu">
                <td valign="middle">
                  <div style="padding-top: 5px;">
                    <h2 class="moveover" style="border-top: 3px double #97D700;"><a href="/insideemu">Inside EMU
                      &#10137;</a></h2>
                    <template v-if="emailBuilderEmail.insideemuPosts.length > 0">
                      <ul style="padding-bottom: 0px; margin-left: 0px; padding-left: 24px; margin-bottom: 5px;">
                        <li v-for="post in emailBuilderEmail.insideemuPosts"
                            style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                          <a style="text-decoration: none;" :href="post.full_url">{{ post.title }}</a>
                        </li>
                      </ul>
                    </template>
                    <template v-else>
                      <p style="padding:5px" class="insufficient">No Inside EMU posts set yet. Select at least one from
                        the "Inside EMU" tab.</p>
                    </template>
                  </div>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <div>
                    <h2 class="moveover" style="border-top: 3px double #97D700;"><a href="/announcement">Announcements
                      &#10137;</a></h2>
                    <template v-if="emailBuilderEmail.announcements.length > 0">
                      <ul style="padding-bottom: 16px; padding-top: 0px; margin-left: 0px; padding-left:24px; margin-top: 5px;">
                        <li v-for="announcement in emailBuilderEmail.announcements"
                            style="padding-bottom: 5px; margin-left: 0; color:#046A38;">
                          <a v-if="announcement.link != ''" style="text-decoration: none;"
                             :href="announcement.link">{{ announcement.title }}</a>
                          <a v-else style="text-decoration: none; "
                             :href="'/announcement/' + announcement.id">{{ announcement.title }}</a>
                        </li>
                      </ul>
                    </template>
                    <template v-else>
                      <p style="padding:0 5px" class="insufficient">No announcements set yet. Select at least one from
                        the "Announcements" tab.</p>
                    </template>
                  </div>
                </td>
              </tr>
              <tr v-if="!emailBuilderEmail.exclude_events">
                <td valign="middle">
                  <div style="padding-top: 5px;">
                    <h2 class="moveover" style="border-top: 3px double #97D700;"><a href="/calendar">What's Happening at
                      EMU &#10137;</a></h2>
                    <div>
                      <template v-if="emailBuilderEmail.events.length > 0">
                        <ul style="margin-left: 0; padding-left: 7px; padding-bottom: 5px;">
                          <li v-for="(evt, i) in emailBuilderEmail.events"
                              style="list-style: none; margin-left: 0; clear: both;" :key="'emailev-'+i">
                            <div
                                style="font-size: 18px; font-weight: bold; line-height: 110%; display: inline-block; width: 50px; height: 50px;  padding: 6px 10px 10px; float: left; text-align: center; margin-bottom: 14px; margin-right: 10px; color:#ffffff; background-color: #2b873b;">
                              {{ dateParse(evt.start_date) }}
                            </div>
                            <div
                                style="width: 72%; display: inline-block; padding-top: 5px; padding-bottom: 10px; float: left;">
                              <a style="text-decoration: none;" :href="evt.full_url">{{ evt.title }}</a></div>
                          </li>
                        </ul>
                      </template>
                      <template v-else>
                        <p style="padding:0 5px" class="insufficient">No events set yet. Select at least one from the
                          "Events" tab.</p>
                      </template>
                    </div>
                    <div style="padding-top:75px;padding-bottom:20px;padding-left:10px;">
                      <a href="/calendar" style="color:#046a38;text-decoration:none" target="_blank">View all calendar
                        events &#10137;</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr style="background:#515151; color:#ffffff; border:0;">
                <td style="border:0; ">
                  <table style="margin-left: auto; margin-right: auto; margin-top: 3px; margin-bottom: 3px;">
                    <tr style="text-align:center; font-size: 12px; text-transform: uppercase; border:0; background-color:#515151; color:#ffffff;">
                      <td>
                        <ul style="list-style: none; padding-left: 0; background:#515151; color:#ffffff;">
                          <li style="display: inline-block; padding: 0; margin: 0;"><a
                              style="color: #ffffff; padding-left: 0px; padding-right: 5px;  text-decoration: none;"
                              href="/">EMU Today</a></li>
                          <li style="display: inline-block; padding: 0; margin: 0;"><a
                              style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;"
                              href="/calendar">Calendar</a></li>
                          <li style="display: inline-block; padding: 0; margin: 0;"><a
                              style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;"
                              href="/announcement">Announcements</a></li>
                          <li style="display: inline-block; padding: 0; margin: 0;"><a
                              style="color: #ffffff; padding-left: 5px; padding-right: 5px; text-decoration: none;"
                              href="/story/news">News</a></li>
                          <li style="display: inline-block; padding: 0; margin: 0;"><a
                              style="color: #ffffff; padding-left: 5px; padding-right: 0; text-decoration: none;"
                              href="/magazine">Eastern Magazine</a></li>
                        </ul>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr id="footer-row" style="background-color: #333333; margin-top: 5px; color: #ffffff; border:0;">
                <td style="border:0; background-color: #333333; color: #ffffff;">
                  <table
                      style="margin-left: auto; margin-right: auto; margin-bottom: 20px;  background-color: #333333; color: #ffffff;">
                    <tr style="border:none; background-color: #333333; color: #ffffff;">
                      <td valign="top" style="padding:5px; border:0; background-color: #333333; color: #ffffff;">
                        <ul style="padding-left: 5px; text-align:center; padding-bottom: 0px; margin-bottom: 0;">
                          <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                            <a href="https://www.facebook.com/EasternMichU/"><img class="img-circle" alt="Facebook"
                                                                                  src="https://www.emich.edu/today/icons/facebook-base-icons.png"></a>
                          </li>
                          <li style="display: inline-block; list-style-type:none; padding-right:7px; margin: 0;">
                            <a href="https://www.emich.edu/communications/expertise/social-media//"><img
                                class="img-circle" alt="X (formerly Twitter)"
                                src="https://www.emich.edu/today/icons/twitter-x.png"></a>
                          </li>
                          <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                            <a href="https://www.youtube.com/user/emichigan08"><img class="img-circle" alt="YouTube"
                                                                                    src="https://www.emich.edu/today/icons/you-tube-base-icons.png"></a>
                          </li>
                          <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                            <a href="https://instagram.com/easternmichigan/"><img class="img-circle" alt="Instagram"
                                                                                  src="https://www.emich.edu/today/icons/instagram-base-icons-new.png"></a>
                          </li>
                          <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                            <a href="https://www.linkedin.com/edu/school?id=18604"><img class="img-circle"
                                                                                        alt="Linked-In"
                                                                                        src="https://www.emich.edu/today/icons/linked-in-base-icons.png"></a>
                          </li>
                          <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                            <a href="https://www.snapchat.com/add/EasternMichigan"><img class="img-circle"
                                                                                        alt="Snap Chat"
                                                                                        src="https://www.emich.edu/today/icons/snapchat.png"></a>
                          </li>
                          <li style="display: inline-block; list-style-type:none; padding-right:7px;margin: 0;">
                            <a href="https://blog.emich.edu/"><img class="img-circle" alt="Blog EMU"
                                                                   src="https://www.emich.edu/today/icons/e-base-icons.png"></a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <tr style="text-align:center;">
                      <td>
                        <ul style="list-style: none; padding-left: 0;">
                          <li style="display: inline-block;"><a
                              style="font-size: 13px; color: #ffffff; padding-left: 0; padding-right: 3px; text-decoration: none;"
                              href="https://www.emich.edu/communications/">Division of Communications</a></li>
                          <li style="font-size: 13px; display: inline-block; color: #ffffff;"> |</li>
                          <li style="display: inline-block;"><a
                              style="font-size: 13px; color: #ffffff; padding-left: 0; padding-left: 3px; text-decoration: none;"
                              href="https://www.emich.edu">Eastern Michigan University</a></li>
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
  </section>
</template>
<style scoped>
.insufficient {
  color: hsl(0, 90%, 70%) !important;
}

body {
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
  /*border: 0;*/
}

div[style*="margin: 16px 0"] {
  margin: 0 !important;
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

a.uppertitle {
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

h2 {
  font-size: 22px;

}

h3 {
  font-size: 20px;
}

h3.mid {
  font-size: 18px;
  padding: 12px 0 8px;
  line-height: 22px;
  text-decoration: none;
}

h3.mid a {
  text-decoration: none;
}

h4 {
  font-size: 18px;
}

h5, h6 {
  font-size: 16px;
}

h2.moveover {
  padding: 14px 0 6px 8px;
  margin-top: 0rem;
  text-decoration: none;
}

h3.moveover {
  padding: 10px 0 6px 8px;
  margin-top: 0rem;
  text-decoration: none;
  font-size: 18px;
}

h2 a {
  text-decoration: none;
  color: #636363 !important;
  font-weight: bold;
}

h3 a {
  text-decoration: none;
  color: #636363 !important;
  font-weight: bold;
}

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

/*a {
    color: #ee6a56;
    text-decoration: underline;
}*/
/* One column layout */
.one-column .contents {
  text-align: left;
  /*width: 100%;*/
}

.one-column p {
  /*font-size: 14px;*/
  font-size: .9rem;
  line-height: 1.3rem;
  Margin-bottom: 10px;
}

/*Two column layout*/
.two-column {
  text-align: center;
  font-size: 0;
  /*width: auto;*/
  position: relative;
  box-sizing: border-box;
  margin-left: 1rem;
  margin-right: 1rem;
}

.two-column .column {
  /*width: 100%;*/
  /*max-width: 300px;*/
  /*max-width: 50%;*/
  /*max-width: 280px;*/
  display: inline-block;
  vertical-align: top;
  position: relative;
  box-sizing: border-box;
}

.contents {
  /*width: 100%;*/
}

.two-column .contents {
  font-size: 14px;
  text-align: left;
  margin-bottom: .3rem;
}

/*.two-column img {
        width: 100%;
        height: auto;
    }*/
.two-column .text {
  padding-top: 0px;
}

/*Media Queries*/
@media only screen and (min-width: 610px) {
  .two-column .column {
    max-width: 49.9% !important;
    width: 49.9%;

  }

  img.col-img {
    max-width: 100% !important;
    width: 100%;
  }

}

@media only screen and (min-width: 480px) and (max-width: 609px) {
  .two-column .column {
    max-width: 49.2% !important;
    width: 49.2%;
  }

  img.col-img {
    max-width: 100% !important;
    width: 100%;
  }

}

@media only screen and (min-width: 10px) and (max-width: 479px) {
  .two-column .column {
    max-width: 100% !important;
    width: 100%;
  }

  img.col-img {
    display: none !important;
  }

  .two-column .text {
    padding-top: 0px;
  }

  .two-column .column h3 {
    padding-top: 0;
  }

  .inner {
    padding-top: 0px;
  }

  .inner h3 {
    padding-top: 0px;
    padding-bottom: 0px;
  }
}
</style>
<script>
import { emailMixin } from './email_mixin'
import moment from 'moment'

export default {
  mixins: [emailMixin],
  data () {
    return {
      deleteConfirm: null,
    }
  },
  methods: {
    dateParse (date) {
      return moment(date).format('MMM DD')
    },
    storyHasTag: function (story, tag) {
      let storyHasTag = false
      story.tags.forEach(function (tg) {
        if (tg.name == tag) {
          storyHasTag = true
        }
      })
      return storyHasTag
    },
    truncate (text, stop) {
      if (text.length > stop) {
        return text.substring(0, stop).replace(/\w+$/, '...')
      }
      else {
        return text
      }
    }
  },
}
</script>
