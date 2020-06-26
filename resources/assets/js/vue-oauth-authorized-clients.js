var Vue = require('vue');

import AuthorizedClients from './components/passport/AuthorizedClients.vue'
new Vue({
    el: '#vue-oauth-authorized-clients',
    components: {AuthorizedClients}
});
