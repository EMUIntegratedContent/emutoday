module.exports = {
    twoWay: true,
     priority: 1000,
    params: ['content'],
      bind: function () {

       console.log(this.setupEditor);
       this.vm.$nextTick(this.setupEditor.bind(this));

     },
     setupEditor: function setUpEditor() {
         var self = this;
         CKEDITOR.replace(this.el.id, {
             customConfig: '/themes/ckeditor_config.js'
         });
        //      filebrowserWindowFeatures: 'resizable=no',
        //      filebrowserBrowseUrl : '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
        //      filebrowserImageBrowseUrl: '/themes/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
        //      filebrowserUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
        //      filebrowserImageUploadUrl : '/themes/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
        //  });

         CKEDITOR.instances[this.el.id].setData(this.params.content);
         CKEDITOR.instances[this.el.id].on('change', function () {
             self.set(CKEDITOR.instances[self.el.id].getData());

         });
     },
     update: function (value) {
    //    $(this.el).val(value).trigger('change')
       if (!CKEDITOR.instances[this.el.id])
           return this.vm.$nextTick(this.update.bind(this, value));
    //    CKEDITOR.instances[this.el.id].setData(value);
       this.vm.onContentChange();

     },
     unbind: function () {
    CKEDITOR.instances[this.el.id].destroy();
    //    $(this.el).off().select2('destroy')
     }
 }
