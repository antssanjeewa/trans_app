// resources/js/routes.js
// Regular User Routes
export const userRoutes = [
    {   
        name: 'dashboard', 
        label: 'Dashboard', 
        icon: "Squares2X2Icon", 
        href: route('dashboard'), 
        active: 'dashboard' 
    },

    { 
        name: 'users', 
        label: 'Users', 
        icon: "UsersIcon", 
        href: route('users.index'), 
        active: 'users*' 
    },
    // Add more regular user routes here
];

// Admin Routes
export const adminRoutes = [
    { 
        name: 'settings', 
        label: 'Settings', 
        icon: "CogIcon", 
        href: route('settings'), 
        active: 'settings' 
    },

    { 
        name: 'roles', 
        label: 'Roles', 
        icon: "FaceSmileIcon", 
        href: route('roles.index'), 
        active: 'roles.*' 
    },

    { 
        name: 'departments', 
        label: 'Departments', 
        icon: "HomeModernIcon", 
        href: route('departments.index'), 
        active: 'departments.*' 
    },
];

