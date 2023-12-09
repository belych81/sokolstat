import { createApp } from 'vue';
import VueRouter from 'vue-router';

Vue.config.productionTip = false

Vue.use(VueRouter)

import App from './pages/teams';

const routes = [
    { path: '/', component: App },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

createApp(App).mount('#tabs');

/*const app = new Vue({
    router,
    render: (h) => h(App)
}).$mount('#tabs');*/