<template>
  <div>
    <div class="box box-solid" :class="type">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-sm-9">
            <h6 class="box-title" @click="showBody = !showBody">{{ article.title }}</h6>
          </div><!-- /.col-md-12 -->
          <div class="col-sm-3">
            <button v-if="!showRemoveBtn" type="button" class="btn btn-sm btn-success pull-right" title="Use this article" @click="useArticle"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            <button v-else type="button" class="btn btn-sm btn-danger pull-right" title="Use this article" @click="removeArticle"><i class="fa fa-close" aria-hidden="true"></i></button>
          </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
      </div>  <!-- /.box-header -->
      <div v-if="showBody" class="box-body">
        <img :src="articleImage.image_path + articleImage.filename" :alt="articleImage.moretext">
        <p>ID: {{article.id}}</p>
        <p>Type: {{article.story_type}}</p>
        <p>Title: {{article.title}}</p>
        <p>Ready: {{article.is_ready}}</p>
        <p>Approved: {{article.is_approved}}</p>
        <p>Promoted: {{article.is_promoted}}</p>
        <p>Featured: {{article.is_featured}}</p>
        <p>Live: {{article.is_live}}</p>
        <p>Archived: {{article.is_archived}}</p>
        <p>Start Date: {{ momentPretty(article.start_date) }}</p>
      </div><!-- /.box-body -->
      <div class="box-footer list-footer">
        <div class="row">
          <div class="col-sm-6">
            Start Date: {{ momentPretty(article.start_date) }}
          </div><!-- /.col-md-6 -->
          <div class="col-sm-6">
            <div class="btn-group pull-right">
              <a
                :href="'/admin/queuearticle/magazine/article/' + article.id + '/edit'"
                target="_blank"
                class="btn btn-xs btn-warning builder-exchange"
              >
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </a>
            </div>
          </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
      </div><!-- /.box-footer -->
    </div><!-- /.box- -->
  </div>
</template>
<script>
import moment from 'moment'
import { builderMixin } from "./builder_mixin";

export default {
  mixins: [ builderMixin ],
  components: {},
  props: {
    article: {
      type: Object,
      required: true
    },
    type: {
      type: String,
      default: 'sub'
    }
  },
  data: function() {
    return {
      showBody: false
    }
  },
  created: function () {

  },
  computed: {
    articleImage() {
      return this.article.images.find(img => {
        return img.image_type == 'small'
      })
    },
    showRemoveBtn() {
      // Determine if the current article is the one being used at this position
      const position = this.modalPosition
      const article_id = this.article.id
      return this.issueArticles[position] && this.issueArticles[position].id == article_id
    }
  },
  methods: {
    momentPretty(datetime) {
      return moment(datetime).format('ddd, MM-DD-YYYY')
    },
    toggleBody: function() {
      if(this.showBody == false) {
        this.showBody = true;
      } else {
        this.showBody = false;
      }
    },
    useArticle() {
      this.$emit('use-article', this.article)
    },
    removeArticle() {
      this.$emit('remove-article')
    }
  },
  watch: {
  },

  filters: {
    momentPretty: {
      read: function(val) {
        return 	val ?  moment(val).format('MM-DD-YYYY') : '';
      },
      write: function(val, oldVal) {
        return moment(val).format('YYYY-MM-DD');
      }
    }
  },
  events: {
  }
};
</script>
<style scoped>
  .box {
    color: #1B1B1B;
    margin-bottom: 10px;
  }
  .box-body {
    background-color: #fff;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    margin:0;
  }

  .box-header {
    padding: 3px;
    cursor: pointer;
  }
  .box-footer {
    padding: 3px;
  }

  .btn-group,
  .btn-group-vertical {
    display:inline-flex;
  }
  h5.box-footer {
    padding: 3px;
  }
  button.footer-btn {
    border-color: #1B1B1B;

  }
  h6.box-title {
    font-size: 16px;
    color: #ffffff;
  }

  .sub  {
    color: #1B1B1B;
    background-color: #001F3F;
    border: 1px solid #cccccc;
  }

  .main  {
    color: #1B1B1B;
    background-color: #00a7d0;
    border: 1px solid #29AB87;
  }

  h6 {
    margin-top: 0;
    margin-bottom: 0;
  }
</style>
