module.exports = {
  twoWay: true,
  priority: 1000,
  params: ['content', 'type'],
  bind: function () {
    this.vm.$nextTick(this.setupEditor.bind(this));
  },
  setupEditor: function setUpEditor() {
     var editorConfigType = (this.params.type == undefined || this.params.type == null || this.params.type == "")?'admin':this.params.type;
     var editorConfig = '/themes/ckeditor_config_'+editorConfigType+'.js'
     var self = this;
     CKEDITOR.replace(this.el.id, {
          customConfig: editorConfig
     });

     CKEDITOR.instances[this.el.id].setData(this.params.content);
     CKEDITOR.instances[this.el.id].on('change', function () {
         self.set(CKEDITOR.instances[self.el.id].getData());
     });
   },
   update: function (value, binding, vnode, oldVnode) {
     if (!CKEDITOR.instances[this.el.id])
       return this.vm.$nextTick(this.update.bind(this, value))

     // For public experts form's ckedior: set ckload to false after first update to prevent cursor from moving to top of editor
     if(this.vm.ckload)
        CKEDITOR.instances[this.el.id].setData(value)

     this.vm.ckload = false
     this.vm.onContentChange()
   },
   unbind: function () {
     CKEDITOR.instances[this.el.id].destroy();
   }

}
