import flatpickr from 'flatpickr';
module.exports = {
    twoWay: true,
  priority: 1000,
    params: ['initval'],
    bind: function () {
        var self = this
        var options = { defaultDate: self.params.initval,
                        enableTime: false,
                        altFormat: "m-d-Y",
                        altInput: true,
                        altInputClass:"form-control",
                        dateFormat: "Y-m-d"}
        options.onChange = this.onChange.bind(this)
        this.pickr = flatpickr(this.el, options )
    },
    onChange: function(dateObj, dateStr) {
         this.vm.onCalendarChange();

        this.set(dateStr)
        // this.set($(this).val())
    }
}
