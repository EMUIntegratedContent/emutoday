module.exports = {
    twoWay: true,
    priority: 1000,
    params: ['complete','userid'],
    bind: function () {
        this.el.addEventListener(
            'submit', this.onSubmit.bind(this)
        );
        console.log('vueajax')
    },

    onSubmit: function (e) {
              e.preventDefault();
                this.el.querySelector('button[type="submit"]').disabled = true;
        var requestType = this.getRequestType();

        this.vm
            .$http[requestType](this.el.action, this.getFormData())
            .then(this.onComplete.bind(this))
            .catch(this.onError.bind(this));


    },

    onComplete: function () {
        if (this.params.complete) {
            console.log(this.params.complete); // Use pretty flash message instead.
        }
    },

    onError: function (response) {
        console.log(response.data.message); // Use pretty flash message instead.
    },
    getFormData: function() {
             // You can use $(this.el) in jQuery and you will get the same thing.
             var serializedData = $(this.el).serializeArray();
             console.log(serializedData);
             var objectData = {};
             $.each(serializedData, function() {
                     if (objectData[this.name] !== undefined) {
                             if (!objectData[this.name].push) {
                                     objectData[this.name] = [objectData[this.name]];
                             }
                             objectData[this.name].push(this.value || '');
                     } else {
                             objectData[this.name] = this.value || '';
                     }
             });
             return objectData;
     },

    getRequestType: function () {
        var method = this.el.querySelector('input[name="_method"]');

        return (method ? method.value : this.el.method).toLowerCase();
    },
}
