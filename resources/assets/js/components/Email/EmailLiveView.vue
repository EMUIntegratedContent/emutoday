<template>
  <section id="email-live-container" style="margin:0 auto; width:620px; padding:10px; border:1px solid #d1d1d1; margin-bottom:20px">
    <table border="0" cellpadding="5" cellspacing="0" height="100%" width="100%" id="bodyTable" style="font-family:arial, sans-serif;">
        <tr>
            <td align="center" valign="top">
                <table border="0" width="600" id="emailContainer">
                    <tr valign="top" id="header-row" style="font-family:arial, sans-serif;">
                      <!--
                      <td colspan="2">
                        <img src="/assets/imgs/email/emailblast_logo_template_600x120.png" width="600" style="padding:5px 0px 5px 0px" alt="EMU Today email blast logo"/>
                      </td>
                      -->
                      <h2>EMU Today Digest</h2>
                    </tr>
                    <!--
                    <tr valign="top" id="title-row">
                      <td colspan="2" style="text-align:center">
                        <header>
                          <h1>{{ email.title }}</h1>
                          <p>{{ email.subheading }}</p>
                        </header>
                      </td>
                    </tr>
                    -->
                    <tr>
                      <td valign="top">
                        <template v-if="email.mainStories[0]">
                          <article>
                            <img :src="'/imagecache/emailmain/' + email.mainStories[0].email_images[0].filename" :alt="email.mainStories[0].email_images[0].title"  style="border-right:5px solid #ffffff; width:600px; height:282px; "/>
                            <h2><a :href="email.mainStories[0].full_url">{{ email.mainStories[0].email_images[0].title }}</a></h2>
                            {{{ email.mainStories[0].email_images[0].teaser | truncate '90' }}}
                          </article>
                        </template>
                        <template v-else>
                          <div style="background-color:#e5e5e5; position:relative; width:600px; height:282px; text-align:center; margin:0 auto; border-right:5px solid #ffffff;">
                            <p style="position:absolute; left:143px; top:121px; font-size:3rem;">Main story image here.</p>
                          </div>
                          <h2 style="padding:0 5px" class="insufficient">No main story set yet.</h2>
                          <p style="padding:0 5px">Select a main story from the "Main Story" tab.</p>
                        </template>
                        <hr />
                      </td>
                    </tr>
                    <tr>
                      <table>
                        <tr>
  												<td colspan="2">
  													<h2><a href="/story/news">News Stories</a></h2>
  												</td>
  											</tr>
                        <tr v-if="email.mainStories.length > 1">
                          <td valign="top" width="300px">
                            <template v-if="email.mainStories[1]">
                              <article>
                                <img :src="'/imagecache/emailsub/' + email.mainStories[1].email_images[0].filename" :alt="email.mainStories[1].email_images[0].title"  style="border-right:5px solid #ffffff;"/>
                                <h3><a :href="email.mainStories[1].full_url">{{ email.mainStories[1].email_images[0].title }}</a></h3>
                                {{{ email.mainStories[1].email_images[0].teaser | truncate '60' }}}
                              </article>
                            </template>
                            <template v-else>
                              <div style="background-color:#e5e5e5; text-align:center; margin:0 auto; border-right:5px solid #ffffff; width:231px; height:210px;">
                                <p style="font-size:3rem;">First sub story image here.</p>
                              </div>
                              <h3 style="padding:0 5px" class="insufficient">No first sub story set yet.</h3>
                              <p style="padding:0 5px">Select a first sub story from the "Main Story" tab.</p>
                            </template>
                          </td>
                          <td valign="top" width="300px">
                            <template v-if="email.mainStories[2]">
                              <article>
                                <img :src="'/imagecache/emailsub/' + email.mainStories[2].email_images[0].filename" :alt="email.mainStories[2].email_images[0].title"  style="border-right:5px solid #ffffff;"/>
                                <h3><a :href="email.mainStories[2].full_url">{{ email.mainStories[2].email_images[0].title }}</a></h3>
                                {{{ email.mainStories[1].email_images[0].teaser | truncate '60' }}}
                              </article>
                            </template>
                            <template v-else>
                              <div style="background-color:#e5e5e5; position:relative; text-align:center; margin:0 auto; border-right:5px solid #ffffff; width:231px; height:210px;">
                                <p style="font-size:3rem;">Second sub story image here.</p>
                              </div>
                              <h3 style="padding:0 5px" class="insufficient">No second sub story set yet.</h3>
                              <p style="padding:0 5px">Select a second sub story from the "Main Story" tab.</p>
                            </template>
                          </td>
                        </tr>
                        <tr v-else>
                          <td>
                            <p class="insufficient">You may add one headline story and two sub stories for a total of three main stories. The two sub stories will go here. If you do not add any sub stories, you will still be able to send the email. However, if you add one sub story, you must add a second.</p>
                          </td>
                        </tr>
                      </table>
                      <hr />
                    </tr>
                    <tr>
                      <td valign="top" colspan="2" style="word-wrap:">
                        <template v-if="email.otherStories.length > 0">
                          <ul>
                            <li v-for="story in email.otherStories">
                              <a :href="story.full_url">{{ story.title }}</a>
                            </li>
                          <ul>
                        </template>
                        <template v-else>
                          <p style="padding:0 5px" class="insufficient">No side stories set yet. Select at least one from the "Side Stories" tab.</p>
                        </template>
                        <hr />
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" colspan="2">
                        <template v-if="email.announcements.length > 0">
                          <h2><a href="/announcements">Announcements</a></h2>
                          <ul>
                            <li v-for="announcement in email.announcements">
                              <a :href="announcement.link">{{ announcement.title }}</a>
                            </li>
                          <ul>
                        </template>
                        <template v-else>
                          <p style="padding:0 5px" class="insufficient">No side stories set yet. Select at least one from the "Side Stories" tab.</p>
                        </template>
                        <hr />
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" colspan="2">
                        <template v-if="email.events.length > 0">
                          <h2><a href="/calendar">What's Happening at EMU</a></h2>
                          <ul>
                            <li v-for="event in email.events">
                              {{ event.start_date }} <a :href="event.full_url">{{ event.title }}</a>
                            </li>
                          <ul>
                        </template>
                        <template v-else>
                          <p style="padding:0 5px" class="insufficient">No events set yet. Select at least one from the "Events" tab.</p>
                        </template>
                        <hr />
                      </td>
                    </tr>
                    <tr style="background:#999999; margin-top:5px; color:#ffffff;">
  										<td>
  											<table>
  												<tr>
  													<td>EMU Today</td>
  													<td>Calendar</td>
  													<td>Announcements</td>
  													<td>News</td>
  													<td>Eastern Magazine</td>
  												</tr>
  											</table>
  										</td>
  									</tr>
  									<tr id="footer-row" style="background:#555555; margin-top:5px; color:#ffffff;">
  										<td colspan="2">
  											<table>
  												<tr>
  													<td valign="top" style="padding:5px; text-align:center">
  														<ul class="social-icons" style="padding-left: 5px;">
  															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.facebook.com/EasternMichU/"><img alt="Facebook" src="/assets/imgs/icons/facebook-base-icons.png"></a></li>
  															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://www.emich.edu/twitter/"><img alt="Twitter" src="/assets/imgs/icons/twitter-base-icons.png"></a></li>
  															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.youtube.com/user/emichigan08"><img alt="YouTube" src="/assets/imgs/icons/you-tube-base-icons.png"></a></li>
  															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://instagram.com/easternmichigan/"><img alt="Instagram" src="/assets/imgs/icons/instagram-base-icons-new.png"></a></li>
  															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.linkedin.com/edu/school?id=18604"><img alt="Linked-In" src="/assets/imgs/icons/linked-in-base-icons.png"></a></li>
  															<li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://blogemu.com/"><img alt="Blog EMU" src="/assets/imgs/icons/e-base-icons.png"></a></li>
  														</ul>
  													</td>
  												</tr>
  												<tr>
  													<td><a href="https://www.emich.edu/communications/">Division of Communications</a> | <a href="https://www.emich.edu">Eastern Michigan University</a></td>
  												</tr>
  											</table>
  										</td>
  									</tr>
                </table>
            </td>
        </tr>
    </table>
  </section>
</template>
<style scoped>
h1 {
    display: block;
    font-size: 2em;
    -webkit-margin-before: 0.67em;
    -webkit-margin-after: 0.67em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
}
p {
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    margin: 0;
}
h3 {
    display: block;
    font-size: 1.17em;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
}
h2 {
    display: block;
    font-size: 1.5em;
    -webkit-margin-before: 0.83em;
    -webkit-margin-after: 0.83em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
}
body, td, input, textarea, select {
    font-family: arial,sans-serif;
}
h4 {
    display: block;
    font-size: 1em;
    -webkit-margin-before: 1.33em;
    -webkit-margin-after: 1.33em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
}

.insufficient{
  color:hsl(0, 90%, 70%) !important;
}
</style>
<script>
export default {
  directives: {},
  components: {},
  props: ['announcements','events','otherStories','mainStories','email'],
  data: function() {
    return {
      deleteConfirm: null,
    }
  },
  ready: function() {

  },
  computed: {

  },
  methods: {
  },
  filters: {
    truncate: function(text, stop, clamp) {
    	return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
    },
  },
  events: {

  },
  watch: {

  },
}
</script>
