<script type="text/javascript" src="/js/flatpickr.min.js"></script>
<script type="text/javascript" src="/js/vendor/vue.js"></script>
<script>
// This is were we init our datetimepicker
new Flatpickr(document.getElementById('start-date'));
new Flatpickr(document.getElementById('end-date'));

// The Vue object
new Vue ({
  // Mount the form element
  el: '#announcement_form',
  data: {
    framework: 'bootstrap',
    record: {
      title: '',
      announcement: '',
      link_txt: '',
      email_link_txt: '',
    },
    totalChars: {
      // Set the max character length for field, will be used in calculations.
      title: 50,
      announcement: 255,
    },
  },
  computed: {
    // Change element class. Public uses foundation, adminlte uses bootstrap
    formWidth: function() {
      return (this.framework == 'foundation' ? '' : 'col-md-7')
    },
    md12col: function() {
      return (this.framework == 'foundation' ? 'medium-12 columns' : 'col-md-12')
    },
    md8col: function() {
      return (this.framework == 'foundation' ? 'medium-8 columns' : 'col-md-8')
    },
    md7col: function() {
      return (this.framework == 'foundation' ? 'medium-7 columns' : 'col-md-7')
    },
    md6col: function() {
      return (this.framework == 'foundation' ? 'medium-6 columns' : 'col-md-6')
    },
    md5col: function() {
      return (this.framework == 'foundation' ? 'medium-5 columns' : 'col-md-5')
    },
    md4col: function() {
      return (this.framework == 'foundation' ? 'medium-4 columns' : 'col-md-4')
    },
    btnPrimary: function() {
      return (this.framework == 'foundation' ? 'button button-primary' : 'btn btn-primary')
    },
    formGroup: function() {
      return (this.framework == 'foundation' ? 'form-group' : 'form-group')
    },
    formControl: function() {
      return (this.framework == 'foundation' ? '' : 'form-control')
    },
    calloutSuccess:function(){
      return (this.framework == 'foundation')? 'callout success':'alert alert-success'
    },
    iconStar: function() {
      return (this.framework == 'foundation' ? 'fi-star ' : 'fa fa-star')
    },
    inputGroupLabel:function(){
      return (this.framework=='foundation')?'input-group-label':'input-group-addon'
    },

    titleChars: function() {
      // Calculate title field character length
      var str = this.record.title;
      var totalchars = this.totalChars.title;
      var cclength = str.length;
      return totalchars- cclength;
    },
    announcementChars: function() {
      // Calculate announcement field character length
      var str = this.record.announcement;
      var totalchars = this.totalChars.announcement;
      var cclength = str.length;
      return totalchars- cclength;
    },
  }
});
</script>
