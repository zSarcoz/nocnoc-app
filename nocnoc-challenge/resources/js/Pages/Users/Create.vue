<script>
export default {
    name: "UserCreate",
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import UsersForm from "@/Components/UsersComponents/UsersForm.vue";



const form = useForm({
    name: "",
    email: "",
    role: "user",
    first_change_password: true,
    password: ""
});
</script>

<template>
    <AppLayout title="Crear Usuario">
        <template #header>
            <div class="flex w-full gap-4">
                <h1 class="font-bold text-3xl">Crear Usuario</h1>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg">
                    <div
                        class="bg-white rounded-lg"
                    >
                        <div class="p-6 bg-white rounded-lg border-b border-gray-200">
                            <UsersForm
                                :form="form"
                                @submit="form.post(route('users.store'))"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
