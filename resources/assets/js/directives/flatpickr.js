import flatpickr from 'flatpickr';
export default {
    twoWay: true,
  priority: 1000,
    params: ['initval'],
    bind: function () {
        var self = this
        var options = { defaultDate: self.params.initval,
                        enableTime: true,
                        altFormat: "m-d-Y h:i K",
                        altInput: true,
                        altInputClass:"form-control",
                        dateFormat: "Y-m-d H:i:S"}
        options.onChange = this.onChange.bind(this)
        this.pickr = flatpickr(this.el, options )
    },
    onChange: function(dateObj, dateStr) {
         this.vm.onCalendarChange();

        this.set(dateStr)
    }
}
