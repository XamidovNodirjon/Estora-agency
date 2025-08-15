import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';

import Navigation from './components/Navigation.vue';

createApp({
    components: {
        Navigation
    }
}).mount('#app'); // Blade ichida #app bo'lishi kerak
