module.exports = {
  twoWay: true,
  bind: function() {
      var self = this;
      var btns = $(self.el).find('.btn');

      btns.each(function() {
          let initValue = $(this).find('input').get(0).value;
          if (initValue === '') {
              $(this).addClass('active');
          }
          $(this).on('click', function() {
              self.set(initValue);
          })
      });
  },
  update: function() {
      var value = this._watcher.value;
      if (value) {
          this.set(value);

          var btns = $(this.el).find('.btn')
          btns.each(function() {
              $(this).removeClass('active');
              $(this).removeClass('bg-purple');
              var v = $(this).find('input').get(0).value;
              if (v === value) {
                  $(this).addClass('active');
                  $(this).addClass('bg-purple');
              }
          });
      } else {
          var input = $(this.el).find('.active input').get(0);
          if (input) {
              this.set(input.value);
          }
      }
  }
}
