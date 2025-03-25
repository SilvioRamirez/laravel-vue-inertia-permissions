import { usePage } from '@inertiajs/vue3'

export function usePermissions() {
    const user = usePage().props.auth.user

    const hasPermission = (permission) => {
        return user.permissions.includes(permission)
    }

    const hasAnyPermission = (permissions) => {
        return permissions.some(permission => hasPermission(permission))
    }

    const hasAllPermissions = (permissions) => {
        return permissions.every(permission => hasPermission(permission))
    }

    const hasRole = (role) => {
        return user.roles.includes(role)
    }

    return {
        hasPermission,
        hasAnyPermission,
        hasAllPermissions,
        hasRole,
        permissions: user.permissions,
        roles: user.roles
    }
} 