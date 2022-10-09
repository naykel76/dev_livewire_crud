import './bootstrap';

import Alpine from 'alpinejs'

import sidebar from './components/sidebar.js'

Alpine.data('sidebar', sidebar)

window.Alpine = Alpine
window.Alpine.start()
