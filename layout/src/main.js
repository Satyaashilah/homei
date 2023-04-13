import { createApp } from 'vue'
import './assets/style.css'
import App from './App.vue'
import router from './plugins/router'
import axios from 'axios'

axios.defaults.withCredentials = true;

axios.interceptors.request.use(function (config) {
    const accessToken = localStorage.getItem('access_token');
    if (accessToken) {
        config.headers['Authorization'] = 'Bearer ' + accessToken;
    }

    console.log(config);
    return config;
  }, function (error) {
    // return Promise.reject(error);
    return error;
  });
createApp(App).use(router).mount('#app')
