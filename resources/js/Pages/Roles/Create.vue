<template>
    <AppLayout title="Crear Rol">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear Rol
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nombre del Rol
                            </label>
                            <input
                                type="text"
                                id="name"
                                v-model="form.name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Permisos
                            </label>
                            <div class="mt-2 space-y-2">
                                <div v-for="permission in permissions" :key="permission.id" class="flex items-center">
                                    <input
                                        type="checkbox"
                                        :id="'permission-' + permission.id"
                                        v-model="form.permissions"
                                        :value="permission.id"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                    >
                                    <label :for="'permission-' + permission.id" class="ml-2 block text-sm text-gray-900">
                                        {{ permission.name }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <Link
                                :href="route('roles.index')"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2"
                            >
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                :disabled="form.processing"
                            >
                                Crear Rol
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    permissions: Array
});

const form = useForm({
    name: '',
    permissions: []
});

const submit = () => {
    form.post(route('roles.store'));
};
</script> 