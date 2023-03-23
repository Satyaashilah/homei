import { createApp } from 'vue'
import './assets/style.css'
import App from './App.vue'
import router from './plugins/router'
import axios from 'axios'

axios.defaults.withCredentials = true
createApp(App).use(router).mount('#app')
