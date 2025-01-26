// resources/js/routes.js
export default [
    { name: 'dashboard', label: 'Dashboard', href: route('dashboard'), active: 'dashboard' },
    
    { name: 'users', label: 'Users', href: route('users.index'), active: 'users*'  },

    { name: 'settings', label: 'Settings', href: route('settings'), active: 'settings'  },
    // Add more routes here
];
