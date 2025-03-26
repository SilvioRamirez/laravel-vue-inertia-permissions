<template>
    <AppLayout title="Roles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Roles
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Lista de Roles</h3>
                        <div class="flex items-center gap-2">

                            <button type="button" class="btn btn-dark btn-sm" @click="exportTable('excel')">
                                <i class="fa fa-file-excel"></i>&nbsp;
                                Excel
                            </button>

                            <button type="button" class="btn btn-dark btn-sm" @click="exportTable('csv')">
                                <i class="fa fa-file-csv"></i>&nbsp;
                                CSV
                            </button>

                            <button type="button" class="btn btn-dark btn-sm" @click="exportTable('txt')">
                                <i class="fa fa-file-text"></i>&nbsp;
                                TXT
                            </button>
                            
                        </div>
                        <Link v-if="canCreateRole"
                            :href="route('roles.create')"
                            class="btn btn-dark btn-sm"
                        > <i class="fa fa-plus-circle"></i>&nbsp;
                            Crear
                        </Link>
                    </div>

                    <vue3-datatable v-if="canViewRole"
                        ref="datatable"
                        :rows="roles" 
                        :columns="cols" 
                        :loading="loading"
                        :sortable="true"
                        :columnFilter="true"
                        :options="{
                            responsive: true,
                            scrollX: true,
                        }"
                    >
                        <template #id="data">
                            <strong>{{ data.value.id }}</strong>
                        </template>
                        <template #name="data">
                            {{ data.value.name }}
                        </template>
                        <template #guard_name="data">
                            {{ data.value.guard_name }}
                        </template>                        
                        <template #created_at="data">
                            {{ data.value.created_at }}
                        </template>
                        <template #updated_at="data">
                            {{ data.value.updated_at }}
                        </template>
                        <template #actions="data">
                            <div class="inline-flex rounded-md shadow-xs" role="group">
                                <Link
                                    v-if="canViewRole"
                                    :href="route('roles.show', data.value.id)"
                                    class="btn-group-init"
                                >
                                    <i class="fas fa-eye"></i>
                                </Link>
                                <Link
                                    v-if="canEditRole"
                                    :href="route('roles.edit', data.value.id)"
                                    class="btn-group-mid"
                                >
                                    <i class="fas fa-edit"></i>
                                </Link>
                                <button
                                    v-if="canDeleteRole"
                                    @click="deleteRole(data.value.id, data.value.name)"
                                    class="btn-group-end"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </template>
                    </vue3-datatable>


                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import { Link, router, useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { usePermissions } from '@/composables/usePermissions';
    import Vue3Datatable from "@bhplugin/vue3-datatable";
    import "@bhplugin/vue3-datatable/dist/style.css";
    import { ref, onMounted } from "vue";
    import Swal from 'sweetalert2';
    import * as XLSX from 'xlsx';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const { hasPermission, hasAnyPermission, hasAllPermissions, hasRole } = usePermissions()

    const canCreateRole = hasPermission('role-create')
    const canEditRole = hasPermission('role-edit')
    const canDeleteRole = hasPermission('role-delete')
    const canViewRole = hasPermission('role-view')

    const props = defineProps({
        roles: Array,
    });

    const cols = ref([
        { field: "actions", title: "Acciones", filter: false, orderable: false, sortable: false, width: "100px", align: "center" },
        { field: "id", title: "ID", width: "90px", filter: false, isUnique: true, type: "number"},
        { field: "name", title: "Nombre" },
        { field: "guard_name", title: "Guard" },
        { field: "created_at", title: "Creación", type: "date", filter: false },
        { field: "updated_at", title: "Actualización", type: "date", filter: false },
    ]);

    const rows = ref([]);
    const loading = ref(true);
    const datatable = ref(null);

    onMounted(() => {
        console.log('Roles data:', props.roles);
        loading.value = false;
    });

    const getRoles = async () => {
        const response = await axios.get(route('roles.index'));
        return response.data;
    }

    const deleteRole = (id, name) => {
        Swal.fire({
            title: '¿Estás seguro de eliminar el rol ' + name + '?',
            text: '¡No podrás revertir esto!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-check"></i> ¡Si, eliminar!',
            cancelButtonText: '<i class="fa fa-ban"></i> Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(route('roles.destroy', id));
            }
        });
    }

    const exportTable = (type) => {
        let records = props.roles;
        if (!records?.length) {
            return;
        }
        const filename = 'roles';

        if (type === 'csv' || type === 'txt') {
            // CSV or TXT
            const coldelimiter = ',';
            const linedelimiter = '\n';
            let result = cols.value
                .filter((d) => !d.hide)
                .map((d) => {
                    return d.title;
                })
                .join(coldelimiter);
            result += linedelimiter;
            records.map((item) => {
                cols.value
                    .filter((d) => !d.hide)
                    .map((d, index) => {
                        if (index > 0) {
                            result += coldelimiter;
                        }
                        const val = d.field.split('.').reduce((acc, part) => acc && acc[part], item);
                        result += val || '';
                    });
                result += linedelimiter;
            });

            if (result === null) return;

            // Agregar BOM para UTF-8
            const BOM = '\uFEFF';
            result = BOM + result;

            if (type === 'csv') {
                const blob = new Blob([result], { type: 'text/csv;charset=utf-8' });
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.setAttribute('href', url);
                link.setAttribute('download', filename + '.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            if (type === 'txt') {
                const blob = new Blob([result], { type: 'text/plain;charset=utf-8' });
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.setAttribute('href', url);
                link.setAttribute('download', filename + '.txt');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        } else if (type === 'excel') {
            // Preparar datos para Excel
            const headers = cols.value
                .filter((d) => !d.hide)
                .map((d) => d.title);

            const data = records.map(item => {
                return cols.value
                    .filter((d) => !d.hide)
                    .map((d) => {
                        const val = d.field.split('.').reduce((acc, part) => acc && acc[part], item);
                        return val || '';
                    });
            });

            // Crear libro de Excel
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet([headers, ...data]);

            // Ajustar ancho de columnas
            const colWidths = headers.map(header => ({ wch: Math.max(header.length, 10) }));
            ws['!cols'] = colWidths;

            // Agregar hoja al libro
            XLSX.utils.book_append_sheet(wb, ws, 'Usuarios');

            // Guardar archivo
            XLSX.writeFile(wb, `${filename}.xlsx`);
        }
    };
    
</script> 