import { usePage } from '@inertiajs/vue3'

export default {
    mounted(el, binding) {
        const { value } = binding
        const permissions = usePage().props.auth.user.permissions

        if (value && value.length > 0) {
            const hasPermission = permissions.includes(value)
            if (!hasPermission) {
                el.parentNode?.removeChild(el)
            }
        }
    }
} 