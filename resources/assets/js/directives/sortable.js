import flatpickr from 'flatpickr';
import Sortable from 'sortablejs';

module.exports = {
    twoWay: true,
    priority: 1000,
    params: ['sorting'],
    bind: function () {
        var self = this
    },
    update: function(options = {}) {
      const sorting = this.params.sorting;
      Sortable.create(this.el, options);
      if (sorting) {
        options.onUpdate = function sortableUpdate(e) {
          const deleted = sorting.splice(e.oldIndex, 1);
          sorting.splice(e.newIndex, 0, deleted[0]);
        };
      }

      Sortable.create(this.el, options);
    }
}
