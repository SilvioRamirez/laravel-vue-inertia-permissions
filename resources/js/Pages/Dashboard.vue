<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-white">
                        <DataTable
                            :data="users"
                            :columns="columns"
                            class="display"
                        >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Components/Welcome.vue';

    //Definir las props para recibir los datos de los usuarios
    const props = defineProps({
        users: Array,
    });

    //Definir las columnas para el DataTable
    const columns = [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
    ];

</script>