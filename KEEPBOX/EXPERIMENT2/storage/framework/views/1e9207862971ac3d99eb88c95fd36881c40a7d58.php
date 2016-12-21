<form method="POST" action="/announcements/form" id="announcement_form" v-bind:class="formWidth">
  <?php echo e(csrf_field()); ?>

  <div class="row">
    <div v-bind:class="md12col">
      <div class="form-group">
        <label for="title" class="help-text" id="title-helptext">Title ({{titleChars}} characters left)</label>
        <input v-model="record.title" maxlength="50" class="form-control <?php if($errors->first('title')): ?> error <?php endif; ?>" name="title" type="text" value="<?php echo e(old('title')); ?>">
        <?php if($errors->first('title')): ?> <span class="error"><?php echo e($errors->first('title')); ?></span> <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="announcement" class="help-text" id="announcement-helptext">Announcement ({{announcementChars}})</label>
        <textarea v-model="record.announcement" maxlength="255" class="form-control <?php if($errors->first('announcement')): ?> error <?php endif; ?>" name="announcement" type="textarea" rows="8"><?php echo e(old('announcement')); ?></textarea>
        <?php if($errors->first('announcement')): ?> <span class="error"><?php echo e($errors->first('announcement')); ?></span> <?php endif; ?>
      </div>
    </div> <!-- /.small-12 columns -->
  </div> <!-- /.row -->
  <div class="row">
    <div v-bind:class="md12col">
      <div class="form-group">
        <label id="link-helptext">Please enter the url for your external web page. (www.yourlink.com)</label>
        <div class="input-group <?php if($errors->first('link')): ?> error <?php endif; ?>">
          <span v-bind:class="inputGroupLabel">http://</span>
          <input class="form-control" name="link" type="text" value="<?php echo e(old('link')); ?>">
        </div>
        <?php if($errors->first('link')): ?> <span class="error"><?php echo e($errors->first('link')); ?></span> <?php endif; ?>
      </div>
    </div><!-- /.col-md-4 -->
  </div><!-- /.row -->
  <div class="row">
    <div v-bind:class="md5col">
      <div class="form-group">
        <label class="help-text" id="link_txt-helptext">External Link Text</label>
        <input v-model="record.link_txt" class="form-control <?php if($errors->first('link_txt')): ?> error <?php endif; ?>" name="link_txt" type="text" value="<?php echo e(old('link_txt')); ?>">
        <?php if($errors->first('link_txt')): ?> <span class="error"><?php echo e($errors->first('link_txt')); ?></span> <?php endif; ?>
      </div>
    </div><!-- /.col-md-4 -->
    <div v-bind:class="md7col" class="right-align" v-show="record.link_txt">
      <label class="help-text">External link will be shown as: </label>
      <input class="form-control form-display" type="text" readonly="readonly" value="For more information visit: {{record.link_txt}}" tabindex="-1"/>
    </div>
  </div>
  <div class="row">
    <div v-bind:class="md12col">
      <div class="form-group">
        <label class="help-text" id="title-helptext">Enter the contact person's email address. (contact@yourlink.com)</label>
        <div class="input-group <?php if($errors->first('email_link')): ?> error <?php endif; ?>">
          <span v-bind:class="inputGroupLabel">mailto:</span>
          <input class="form-control" name="email_link" type="text" value="<?php echo e(old('email_link')); ?>">
        </div>
        <?php if($errors->first('email_link')): ?> <span class="error"><?php echo e($errors->first('email_link')); ?></span> <?php endif; ?>
      </div>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div v-bind:class="md5col">
      <div class="form-group">
        <label class="help-text" id="email-link-helptext">Email Link Text</label>
        <input v-model="record.email_link_txt" class="form-control <?php if($errors->first('email_link_txt')): ?> error <?php endif; ?>" name="email_link_txt" type="text" value="<?php echo e(old('email_link_txt')); ?>">
        <?php if($errors->first('email_link_txt')): ?> <span class="error"><?php echo e($errors->first('email_link_txt')); ?></span> <?php endif; ?>
      </div>
    </div><!-- /.col-md-5 -->
    <div v-bind:class="md7col" class="right-align" v-show="record.email_link_txt">
      <label class="help-text">Email will be shown as: </label>
      <input class="form-control form-display" type="text" readonly="readonly" value="Contact: {{record.email_link_txt}}" tabindex="-1"/>
    </div>
  </div>
  <div class="row">
    <div v-bind:class="md6col">
      <div class="form-group">
        <label for="start-date">Start Date</label>
        <input id="start-date" placeholder="Pick Start Date" readonly="readonly" class="form-display flatpickr-input form-control <?php if($errors->first('title')): ?> error <?php endif; ?>" name="start_date"type="text" value="<?php echo e(old('start_date')); ?>">
        <?php if($errors->first('start_date')): ?> <span class="error"><?php echo e($errors->first('start_date')); ?></span> <?php endif; ?>
      </div> <!--form-group -->
    </div> <!-- /.small-6 columns -->
    <div v-bind:class="md6col">
      <div class="form-group">
        <label for="end-date">End Date</label>
        <input id="end-date" placeholder="Pick Start Date" readonly="readonly" class="form-display flatpickr-input form-control <?php if($errors->first('title')): ?> error <?php endif; ?>" name="end_date" type="text" value="<?php echo e(old('end_date')); ?>">
        <?php if($errors->first('end_date')): ?> <span class="error"><?php echo e($errors->first('end_date')); ?></span> <?php endif; ?>
      </div> <!--form-group -->
    </div> <!-- /.small-6 columns -->
  </div> <!-- /.row -->
  <div class="row">
    <div v-bind:class="md12col">
      <div class="form-group">
        <button type="submit" v-bind:class="btnPrimary">Submit For Approval</button>
      </div>
    </div>
  </div>
</form>
