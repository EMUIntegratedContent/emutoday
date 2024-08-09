<template>
  <div>
    <div :class="item.is_live ? 'livetime' : ''" class="box box-solid">
      <div class="box-header with-border">
        <div class="row">
          <div class="col-sm 12 col-md-4">
            <div class="box-date-top pull-left">{{ titleDateLong(item.start_date) }}</div>
          </div><!-- /.col-sm-6 -->
          <div class="col-sm 12 col-md-8">
            <label v-if="podType === 'postqueue'" class="pull-right"><input type="checkbox" @click="togglePost(item)"
                                                                            v-model="checked" :checked="isPost"/>
              Email Post</label>
            <button v-if="podType === 'post'" type="button" class="btn btn-sm btn-danger pull-right"
                    @click="removeInsidePost(item.postId)"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div><!-- /.col-sm-6 -->
        </div><!-- /.row -->
        <div class="row">
          <a v-on:click.prevent="toggleBody" href="#">
            <div class="col-sm-12">
              <h6 class="box-title">{{ item.title }}</h6>
            </div><!-- /.col-md-12 -->
          </a>
        </div><!-- /.row -->
      </div>  <!-- /.box-header -->
      <div v-if="showBody" class="box-body">
        <p>ID: {{ item.postId }}</p>
        <p>Title: {{ item.title }}</p>
        <p>Start Date: {{ item.start_date }}</p>
        <p>End Date: {{ item.end_date ? item.end_date : 'Not set' }}</p>
      </div><!-- /.box-body -->
      <div class="box-footer list-footer">
        <div class="row">
          <div class="col-sm-6">
            Live {{ timefromNow }}
          </div><!-- /.col-md-6 -->
          <div class="col-sm-6">
            <div class="btn-group pull-right">
              <a :href="`/admin/insideemu/posts/${item.postId}/edit`" target="_blank"
                 class="btn bg-orange btn-xs footer-btn" data-toggle="tooltip"
                 title="preview"><i class="fa fa-pencil"></i></a>
            </div>
          </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
      </div><!-- /.box-footer -->
    </div><!-- /.box- -->
  </div>
</template>
<style scoped>
.box {
  color: #1B1B1B;
  margin-bottom: 10px;
}

.box-body {
  background-color: #fff;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  margin: 0;
}

.box-header {
  padding: 3px;
}

.box-footer {
  padding: 3px;
}

h5.box-footer {
  padding: 3px;
}

button.footer-btn {
  border-color: #999999;

}

h6.box-title {
  font-size: 16px;
  color: #1B1B1B;
}

form {
  display: inline-block;
}

form.mediaform {
  margin-top: 1rem;
}

.btn-group,
.btn-group-vertical {
  display: inline-flex;
}

select.form-control {
  height: 22px;
  border: 1px solid #999999;
}

h6 {
  margin-top: 0;
  margin-bottom: 0;
}

h5 {
  margin-top: 0;
  margin-bottom: 0;
}

.form-group label {
  margin-bottom: 0;
}

.livetime {
  border: 1px solid #aaaaaa;
  background-color: #E8F5E9;
}
</style>
<script>
import { emailMixin } from './email_mixin'
import moment from 'moment'

export default {
  components: {},
  mixins: [emailMixin],
  props: ['item', 'pid', 'podType'],
  data: function () {
    return {
      showBody: false,
      showPanel: false,
      itemCurrent: 1,
      checked: false,
    }
  },
  computed: {
    isPost: function () {
      if (this.emailBuilderEmail.insideemuPosts) {
        for (let i = 0; i < this.emailBuilderEmail.insideemuPosts.length; i++) {
          if (this.emailBuilderEmail.insideemuPosts[i].postId == this.item.postId) {
            this.checked = true
            return true
          }
        }
      }
      this.checked = false
      return false
    },
    timefromNow: function () {
      return moment(this.item.start_date).fromNow()
    },
  },
  methods: {
    momentPretty (datetime) {
      return moment(datetime).format('ddd, MM-DD-YYYY')
    },
    // Handle the form submission here
    timeDiffNow: function (val) {
      return moment(val).diff(moment(), 'minutes');
    },
    toggleBody: function () {
      if (!this.showBody) {
        this.showBody = true;
      }
      else {
        this.showBody = false;
      }
    },
    togglePost: function (post) {
      // function will run before this.checked is switched
      if (!this.checked) {
        this.addInsidePost(post)
      }
      else {
        this.removeInsidePost(post.postId)
      }
    },
    titleDateLong: function (value) {
      return moment(value).format("ddd MM/DD")
    }
  }
};


</script>
