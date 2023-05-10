<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="president-chk">
                    Include the presidential section in this email? <input type="checkbox" id="president-chk" v-model="isPresidentIncluded" aria-label="">
                </label>
            </div><!-- /input-group -->
        </div><!-- /.col-md-12 -->
        <div class="col-xs-12">
            <div class="form-group">
              <label for="presidentTeaser">Subheading (optional)</label>
              <textarea class="form-control" id="presidentTeaser" v-model="teaser">{{ teaser }}</textarea>
            </div>
        </div><!-- /.col-md-12 -->
        <div class="col-xs-12">
            <div class="form-group">
              <label for="presidentUrl"><strong>URL to president's statement</strong></label>
              <input type="text" class="form-control" id="presidentUrl" v-model="presidentUrl" />
            </div>
        </div><!-- /.col-md-12 -->
    </div><!-- ./row -->
</template>
<style scoped>
</style>
<script>

export default  {
  directives: {},
  components: {},
  props: ['teaser', 'presidentUrl'],
  data: function() {
    return {
        isPresidentIncluded: false
    }
  }
}
</script>
