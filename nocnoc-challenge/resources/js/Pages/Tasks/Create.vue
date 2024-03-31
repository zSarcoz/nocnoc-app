<script>
export default {
    name: "TasksCreate",
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TasksForm from "@/Components/TasksComponents/TasksForm.vue";

defineProps({
    users:{
        type: Object,
        required: true,
    }
})

const form = useForm({
    title: "",
    description: "",
    status: "Pendiente",
    content_uri: "content_uri",
    user_id: 1,
    user_assigned: ""
});
</script>

<template>
    <AppLayout title="Crear Tarea">
        <template #header>
            <div class="flex w-full gap-4">
                <h1 class="font-bold text-3xl">Crear Tarea</h1>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg">
                    <div
                        class="bg-white rounded-lg"
                    >
                        <div class="p-6 bg-white rounded-lg border-b border-gray-200">
                            <TasksForm
                                :form="form"
                                :users="users"
                                @submit="form.post(route('tasks.store'))"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
