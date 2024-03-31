<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1>HELOOOO</h1>

            {{ $page.props.user.roles }}
        </div>
    </div>
</template>
