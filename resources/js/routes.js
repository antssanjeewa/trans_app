// resources/js/routes.js
// Regular User Routes
export const userRoutes = [
    { name: 'dashboard', label: 'Dashboard', href: route('dashboard'), active: 'dashboard' },
    { name: 'users', label: 'Users', href: route('users.index'), active: 'users*' },
    // Add more regular user routes here
];

// Admin Routes
export const adminRoutes = [
    { name: 'settings', label: 'Settings', href: route('settings'), active: 'settings' },
    { name: 'roles', label: 'Roles', href: route('roles.index'), active: 'roles.*' },
];

