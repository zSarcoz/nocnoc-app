<script>
export default {
    name: "TasksEdit",
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TasksForm from "@/Components/TasksComponents/TasksForm.vue";

const props = defineProps({
    task: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    user_assigned: props.task.user_assigned,
    status: props.task.status,
    content_uri: props.task.content_uri,
    user_id: props.task.user_id,
});
console.log("🚀 ~ props:", props);
console.log("🚀 ~ form:", form);
</script>

<template>
    <AppLayout title="Editar Tarea">
        <template #header>
            <div class="flex w-full gap-4">
                <h1 class="font-bold text-3xl">Editar Tarea</h1>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div
                        class="p-6 bg-white rounded-lg border-b border-gray-200"
                    >
                        <TasksForm
                            :updating="true"
                            :form="form"
                            @submit="form.put(route('tasks.update', task.id))"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
