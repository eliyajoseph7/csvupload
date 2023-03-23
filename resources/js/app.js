import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Turbolinks from 'turbolinks';
window.Alpine = Alpine;

Alpine.plugin(focus);
window.Turbolinks = Turbolinks;

Turbolinks.start();
Alpine.start();
