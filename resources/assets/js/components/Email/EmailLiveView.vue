<template>
  <section id="email-live-container" style="margin:0 auto; width:620px; padding:10px; border:1px solid #d1d1d1; overflow:scroll; overflow-y: hidden; margin-bottom:20px">
    <table border="0" cellpadding="5" cellspacing="0" height="100%" width="100%" id="bodyTable" style="font-family:arial, sans-serif;">
        <tr>
            <td align="center" valign="top">
                <table border="0" width="600" id="emailContainer">
                    <tr valign="top" id="header-row" style="font-family:arial, sans-serif;">
                      <td colspan="2">
                        <img src="/assets/imgs/email/emailblast_logo_template_600x120.png" width="600" style="padding:5px 0px 5px 0px" alt="EMU Today email blast logo"/>
                      </td>
                    </tr>
                    <tr valign="top" id="title-row">
                      <td colspan="2" style="text-align:center">
                        <header>
                          <h1>{{ email.title }}</h1>
                          <p>{{ email.subheading }}</p>
                        </header>
                      </td>
                    </tr>
                    <tr>
                        <td valign="top" width="368">
                          <template v-if="email.mainStory">
                            <article>
                              <img :src="email.mainStory.email_images[0].image_path + email.mainStory.email_images[0].filename" :alt="email.mainStory.email_images[0].title"  style="border-right:5px solid #ffffff; width:368px; height:245px; "/>
                              <h2>{{email.mainStory.title}}</h2>
                              {{{ email.mainStory.content | truncate '60' }}}
                              <p><a :href="email.mainStory.full_url">Read More</a></p>
                            </article>
                          </template>
                          <template v-else>
                            <div style="background-color:#e5e5e5; position:relative; width:368px; height:245px; text-align:center; margin:0 auto; border-right:5px solid #ffffff;">
                              <p style="position:absolute; left:38px; top:96px; font-size:3rem;">Main story image here.</p>
                            </div>
                            <h2 style="padding:0 5px" class="insufficient">No main story set yet.</h2>
                            <p style="padding:0 5px">Select a main story from the "Main Story" tab.</p>
                          </template>
                          <hr />
                        </td>
                        <td rowspan="3" valign="top" width="232" style="background:#e5e5e5">
                          <template v-if="email.events.length > 0">
                            <h3 style="padding:0 5px">Upcoming Events</h3>
                            <article v-for="event in email.events" style="padding:0 5px">
                              <hr />
                              <h4>{{event.title}}<h4>
                              {{ event.start_date }} | {{ event.start_time }} | {{ event.location }}
                              <p><a :href="event.full_url">View Event</a></p>
                            </article>
                          </template>
                          <template v-else>
                            <p style="padding:0 5px" class="insufficient">No events set yet. Select at least one from the "Events" tab.</p>
                          </template>
                        </td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <template v-if="email.otherStories.length > 0">
                          <h3>Featured News Stories</h3>
                          <article v-for="story in email.otherStories">
                            <h4>{{story.title}}</h4>
                            {{{ story.content | truncate '30' }}}
                            <p><a :href="story.full_url">Read More</a></p>
                          </article>
                        </template>
                        <template v-else>
                          <p style="padding:0 5px" class="insufficient">No side stories set yet. Select at least one from the "Side Stories" tab.</p>
                        </template>
                        <hr />
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <template v-if="email.announcements.length > 0">
                          <h3>Announcements</h3>
                          <article v-for="announcement in email.announcements">
                            <h4>{{ announcement.title }}</h4>
                            <p>{{ announcement.announcement | truncate '30' }}</p>
                            <p><a :href="announcement.link">{{ announcement.link_txt }}</a></p>
                          </article>
                        </template>
                        <template v-else>
                          <p style="padding:0 5px" class="insufficient">No announcements set yet. Select at least one from the "Announcements" tab.</p>
                        </template>
                      </td>
                    </tr>
                    <tr id="footer-row" style="background:#555555; margin-top:5px; color:#ffffff;">
                        <td valign="top" width="368" style="padding:5px">
                          <ul class="social-icons" style="padding-left: 5px;">
                            <li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.facebook.com/EasternMichU/"><img alt="Facebook" src="/assets/imgs/icons/facebook-base-icons.png"></a></li>
                            <li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://www.emich.edu/twitter/"><img alt="Twitter" src="/assets/imgs/icons/twitter-base-icons.png"></a></li>
                            <li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.youtube.com/user/emichigan08"><img alt="YouTube" src="/assets/imgs/icons/you-tube-base-icons.png"></a></li>
                            <li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://instagram.com/easternmichigan/"><img alt="Instagram" src="/assets/imgs/icons/instagram-base-icons-new.png"></a></li>
                            <li style="float:left; list-style-type:none; padding-right:10px;"><a href="https://www.linkedin.com/edu/school?id=18604"><img alt="Linked-In" src="/assets/imgs/icons/linked-in-base-icons.png"></a></li>
                            <li style="float:left; list-style-type:none; padding-right:10px;"><a href="http://blogemu.com/"><img alt="Blog EMU" src="/assets/imgs/icons/e-base-icons.png"></a></li>
                          </ul>
                        </td>
                        <td valign="top" width="232" style="padding:5px; text-align:center">
                          <a style="color:#ffffff" href="https://today.emich.edu">EMU Today</a> | <a style="color:#ffffff" href="https://today.emich.edu/magazine">Eastern Magazine</a>
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
