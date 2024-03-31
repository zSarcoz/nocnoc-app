<script>
export default {
    name: "TasksIndex",
};
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItems,
    MenuItem,
} from "@headlessui/vue";
import { ChevronUpIcon } from "@heroicons/vue/20/solid";
import { Ellipsis, Pencil, Trash2 } from "lucide-vue-next";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    tasks: {
        type: Object,
        required: true,
    },
});

const deleteTask = (id) => {
    if (confirm("are you sure?")) {
        Inertia.delete(route("tasks.destroy", id));
    }
};
</script>

<template>
    <AppLayout title="Tareas">
        <template #header>
            <div class="flex w-full gap-4 items-center justify-between">
                <div class="flex w-1/2 gap-4 items-center">
                    <h1 class="font-bold text-3xl">Tareas</h1>
                    <span
                        class="inline-flex font-bold items-center rounded-md bg-[#6875F5] px-2 h-6 text-xs text-white ring-1 ring-inset ring-gray-500/10"
                        >{{ tasks.data.length }}
                    </span>
                </div>
                <div
                    class="flex justify-between"
                    v-if="$page.props.user.permissions.includes('create tasks')"
                >
                    <Link
                        :href="route('tasks.create')"
                        class="rounded-md bg-[#6875F5] px-2 py-2 text-lg text-white"
                    >
                        Crear Tareas</Link
                    >
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap justify-between w-full px-4 lg:px-0">
                    <!-- TASKS CARDS -->
                    <div
                        class="w-full lg:w-full pt-16"
                        v-for="task in tasks.data"
                        v-if="$page.props.user.roles.includes('user')"
                    >
                        <div
                            class="flex w-full rounded-2xl bg-white shadow-md transition duration-300 ease-in-out transform hover:scale-110"
                        >
                            <div class="w-full rounded-2xl bg-white">
                                <Disclosure v-slot="{ open }">
                                    <DisclosureButton
                                        class="flex w-full justify-between items-center rounded-lg bg-white px-4 py-2 text-left text-sm font-bold text-black focus:outline-none focus-visible:ring focus-visible:ring-slate-500/75"
                                    >
                                        <div class="flex flex-col">
                                            <span class="text-xl">{{
                                                task.title
                                            }}</span>
                                            <span
                                                class="text-sm text-gray-400 font-normal"
                                                >{{ task.user_assigned }}</span
                                            >
                                        </div>

                                        <ChevronUpIcon
                                            :class="
                                                open
                                                    ? 'rotate-180 transform'
                                                    : ''
                                            "
                                            class="hidden h-5 w-5 text-gray lg:flex"
                                        />
                                    </DisclosureButton>
                                    <DisclosurePanel
                                        class="px-4 pb-2 pt-4 text-sm text-gray-500"
                                    >
                                        {{ task.description }}
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>

                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                                v-if="
                                    $page.props.user.permissions.includes(
                                        'create tasks'
                                    )
                                "
                            >
                                <!-- <div> -->
                                <MenuButton
                                    class="w-8 h-8 mt-4 flex justify-center items-center rounded-full bg-white hover:bg-slate-100"
                                >
                                    <Ellipsis color="#787878" />
                                </MenuButton>
                                <!-- </div> -->
                                <transition
                                    enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0"
                                >
                                    <MenuItems
                                        class="absolute z-50 right-0 mt-2 w-36 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                                    >
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    :href="
                                                        route(
                                                            'tasks.edit',
                                                            task.id
                                                        )
                                                    "
                                                    v-if="
                                                        $page.props.user.permissions.includes(
                                                            'update tasks'
                                                        )
                                                    "
                                                >
                                                    <button
                                                        :class="[
                                                            active
                                                                ? 'bg-[#6875F5] text-white'
                                                                : 'text-gray-900',
                                                            'group flex w-full items-center gap-4 rounded-md px-2 py-2 text-sm',
                                                        ]"
                                                    >
                                                        <Pencil
                                                            :size="16"
                                                            :class="[
                                                                active
                                                                    ? 'text-white'
                                                                    : 'text-gray-500',
                                                            ]"
                                                        />
                                                        Edit
                                                    </button>
                                                </Link>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    @click="deleteTask(task.id)"
                                                    v-if="
                                                        $page.props.user.permissions.includes(
                                                            'delete tasks'
                                                        )
                                                    "
                                                >
                                                    <button
                                                        @click="
                                                            deleteTask(task.id)
                                                        "
                                                        :class="[
                                                            active
                                                                ? 'bg-[#6875F5] text-white'
                                                                : 'text-gray-900',
                                                            'group flex w-full items-center gap-4 rounded-md px-2 py-2 text-sm',
                                                        ]"
                                                    >
                                                        <Trash2
                                                            :size="16"
                                                            :class="[
                                                                active
                                                                    ? 'text-white'
                                                                    : 'text-gray-500',
                                                            ]"
                                                        />

                                                        Delete
                                                    </button>
                                                </Link>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                    <div
                        class="w-full lg:w-2/5 pt-16"
                        v-for="task in tasks.data"
                        v-if="
                            $page.props.user.permissions.includes(
                                'create tasks'
                            )
                        "
                    >
                        <div
                            class="flex w-full rounded-2xl bg-white shadow-md transition duration-300 ease-in-out transform hover:scale-110"
                        >
                            <div class="w-full rounded-2xl bg-white">
                                <Disclosure v-slot="{ open }">
                                    <DisclosureButton
                                        class="flex w-full justify-between items-center rounded-lg bg-white px-4 py-2 text-left text-sm font-bold text-black focus:outline-none focus-visible:ring focus-visible:ring-slate-500/75"
                                    >
                                        <div class="flex flex-col">
                                            <span class="text-xl">{{
                                                task.title
                                            }}</span>
                                            <span
                                                class="text-sm text-gray-400 font-normal"
                                                >{{ task.user_assigned }}</span
                                            >
                                        </div>

                                        <ChevronUpIcon
                                            :class="
                                                open
                                                    ? 'rotate-180 transform'
                                                    : ''
                                            "
                                            class="hidden h-5 w-5 text-gray lg:flex"
                                        />
                                    </DisclosureButton>
                                    <DisclosurePanel
                                        class="px-4 pb-2 pt-4 text-sm text-gray-500"
                                    >
                                        {{ task.description }}
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>

                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                                v-if="
                                    $page.props.user.permissions.includes(
                                        'create tasks'
                                    )
                                "
                            >
                                <!-- <div> -->
                                <MenuButton
                                    class="w-8 h-8 mt-4 flex justify-center items-center rounded-full bg-white hover:bg-slate-100"
                                >
                                    <Ellipsis color="#787878" />
                                </MenuButton>
                                <!-- </div> -->
                                <transition
                                    enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0"
                                >
                                    <MenuItems
                                        class="absolute z-50 right-0 mt-2 w-36 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                                    >
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    :href="
                                                        route(
                                                            'tasks.edit',
                                                            task.id
                                                        )
                                                    "
                                                    v-if="
                                                        $page.props.user.permissions.includes(
                                                            'update tasks'
                                                        )
                                                    "
                                                >
                                                    <button
                                                        :class="[
                                                            active
                                                                ? 'bg-[#6875F5] text-white'
                                                                : 'text-gray-900',
                                                            'group flex w-full items-center gap-4 rounded-md px-2 py-2 text-sm',
                                                        ]"
                                                    >
                                                        <Pencil
                                                            :size="16"
                                                            :class="[
                                                                active
                                                                    ? 'text-white'
                                                                    : 'text-gray-500',
                                                            ]"
                                                        />
                                                        Edit
                                                    </button>
                                                </Link>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    @click="deleteTask(task.id)"
                                                    v-if="
                                                        $page.props.user.permissions.includes(
                                                            'delete tasks'
                                                        )
                                                    "
                                                >
                                                    <button
                                                        @click="
                                                            deleteTask(task.id)
                                                        "
                                                        :class="[
                                                            active
                                                                ? 'bg-[#6875F5] text-white'
                                                                : 'text-gray-900',
                                                            'group flex w-full items-center gap-4 rounded-md px-2 py-2 text-sm',
                                                        ]"
                                                    >
                                                        <Trash2
                                                            :size="16"
                                                            :class="[
                                                                active
                                                                    ? 'text-white'
                                                                    : 'text-gray-500',
                                                            ]"
                                                        />

                                                        Delete
                                                    </button>
                                                </Link>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
