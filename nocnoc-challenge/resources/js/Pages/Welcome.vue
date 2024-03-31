<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img
            id="background"
            class="absolute -left-20 top-0 max-w-[877px] opacity-50"
            src="https://laravel.com/assets/img/welcome/background.svg"
        />
        <img
            id="background"
            class="absolute -right-0 bottom-[-19rem] lg:bottom-[-17rem] max-w-[950px] h-[750px] rotate-180 opacity-45 blur-sm"
            src="https://laravel.com/assets/img/welcome/background.svg"
        />
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <div class="flex lg:justify-center lg:col-start-2"></div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="transition duration-300 ease-in-out transform hover:scale-110 rounded-md px-3 py-2 text-black ring-1 ring-transparent hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>
                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="transition duration-300 ease-in-out transform hover:scale-110 rounded-md px-3 py-2 text-black ring-1 ring-transparent hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Registrar Usuarios
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="h-[120dvh]">
                    <div
                        class="w-full h-56 flex justify-center items-center flex-col gap-4"
                    >
                        <h1
                            class="text-7xl font-bold text-white text-center transition duration-500 ease-in-out transform hover:scale-110"
                        >
                            NocNoc Challenge
                        </h1>
                        <h2 class="text-xl font-bold text-gray-300">
                            Prueba de NocNoc x XY Company
                        </h2>
                    </div>

                    <div
                        class="w-full flex flex-col justify-center items-center mt-20"
                    >
                        <span class="w-1/2 text-center text-white">
                            <b>Organiza</b> tu día con facilidad. Nuestra
                            plataforma te permite
                            <b>gestionar tus tareas</b> diarias de manera
                            eficiente. Regístrate hoy y simplifica tu
                            vida.</span
                        >
                        <Link :href="route('login')" class="mt-10">
                            <button
                                class="transition duration-300 ease-in-out transform hover:scale-110 border-2 border-red-500 rounded-full px-6 py-2 text-white font-semibold hover:bg-red-600"
                            >
                                Empezar
                            </button>
                        </Link>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
