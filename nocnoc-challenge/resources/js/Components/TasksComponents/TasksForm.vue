<script>
export default {
    name: "TasksForm",
};
</script>

<script setup>
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, computed } from "vue";
import { defineProps, defineEmits, watch } from "vue";
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
    form: {
        type: Object,
        required: true,
    },
    updating: {
        type: Boolean,
        required: false,
        default: false,
    },
    users: {
        type: Object,
        required: true,
    },
});

// watch(props.form, (newForm, oldForm) => {
//     if (newForm.user_assigned !== oldForm.user_assigned) {
//         console.log("user_assigned changed:", newForm.user_assigned);
//     }
// });

defineEmits(["submit"]);

const people = [
    { id: 1, name: "Wade Cooper" },
    { id: 2, name: "Arlene Mccoy" },
    { id: 3, name: "Devon Webb" },
    { id: 4, name: "Tom Cook" },
    { id: 5, name: "Tanya Fox" },
    { id: 6, name: "Hellen Schmidt" },
];

let selected = ref(people[0]);
let query = ref("");

let filteredPeople = computed(() =>
    query.value === ""
        ? people
        : people.filter((person) =>
              person.name
                  .toLowerCase()
                  .replace(/\s+/g, "")
                  .includes(query.value.toLowerCase().replace(/\s+/g, ""))
          )
);

// console.log("user_assigned: ", props.form.user_assigned);
</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? "Editar Tarea" : "Crear Nueva Tarea" }}
        </template>
        <template #description>
            {{
                updating
                    ? "Editar la tarea seleccionada"
                    : "Crea una Nueva Tarea para un usuario"
            }}
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="title" value="Título" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    autocomplete="name"
                    class="mt-1 block w-full"
                />
                <InputError :message="$page.props.errors.title" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="description" value="Descripción" />
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    autocomplete="description"
                    class="mt-1 block w-full"
                />
                <!-- <InputError :message="$page.props.errors.name" class="mt-2" /> -->
            </div>
            <div class="col-span-6 sm:col-span-6">
                <!-- <div class="w-full flex items-center gap-2"> -->
                <InputLabel
                    for="user_assigned"
                    value="Usuario Asignado"
                    v-if="updating"
                />
                <TextInput
                    id="user_assigned"
                    v-model="form.user_assigned"
                    type="text"
                    autocomplete="name"
                    class="mt-1 block w-full"
                    v-if="updating"
                />
                <!-- <Combobox v-model="selected">
                        <div class="relative mt-1">
                            <div
                                class="relative w-full cursor-default overflow-hidden rounded-lg border border-gray-300 bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
                            >
                                <ComboboxInput
                                    v-model="props.form.user_assigned"
                                    class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                                    :displayValue="(person) => person.name"
                                    @change="query = $event.target.value"
                                />
                                <ComboboxButton
                                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                                >
                                    <ChevronUpDownIcon
                                        class="h-5 w-5 text-gray-400"
                                        aria-hidden="true"
                                    />
                                </ComboboxButton>
                            </div>
                            <TransitionRoot
                                leave="transition ease-in duration-100"
                                leaveFrom="opacity-100"
                                leaveTo="opacity-0"
                                @after-leave="query = ''"
                            >
                                <ComboboxOptions
                                    class="absolute z-50 mt-1 max-h-60 w-full overflow-scroll rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                                >
                                    <div
                                        v-if="
                                            filteredPeople.length === 0 &&
                                            query !== ''
                                        "
                                        class="relative cursor-default select-none px-4 py-2 text-gray-700"
                                    >
                                        Nothing found.
                                    </div>

                                    <ComboboxOption
                                        v-for="person in filteredPeople"
                                        as="template"
                                        :key="person.id"
                                        :value="person"
                                        v-slot="{ selected, active }"
                                    >
                                        <li
                                            class="relative cursor-default select-none py-2 pl-10 pr-4"
                                            :class="{
                                                'bg-[#6875F5] text-white':
                                                    active,
                                                'text-gray-900': !active,
                                            }"
                                        >
                                            <span
                                                class="block truncate"
                                                :class="{
                                                    'font-medium': selected,
                                                    'font-normal': !selected,
                                                }"
                                            >
                                                {{ person.name }}
                                            </span>
                                            <span
                                                v-if="selected"
                                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                                                :class="{
                                                    'text-white': active,
                                                    'text-teal-600': !active,
                                                }"
                                            >
                                                <CheckIcon
                                                    class="h-5 w-5"
                                                    aria-hidden="true"
                                                />
                                            </span>
                                        </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                            </TransitionRoot>
                        </div>
                    </Combobox> -->
                <!-- </div> -->
            </div>
            <div class="col-span-6 sm:col-span-6" v-if="!updating">
                <InputLabel for="user_assigned" value="Usuario Asignado" />

                <select
                    name="user_id"
                    value="user_id"
                    v-model="form.user_assigned"
                    class="w-56 mt-2 border border-gray-300 rounded-md"
                >
                    <!-- <TransitionRoot
                        leave="transition ease-in duration-100"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                    > -->
                        <option v-for="user in users" :value="user.name">
                            {{ user.name }}
                        </option>
                    <!-- </TransitionRoot> -->
                </select>
                <InputError
                    :message="$page.props.errors.user_id"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <PrimaryButton>{{ updating ? "Editar" : "Crear" }}</PrimaryButton>
        </template>
    </FormSection>
</template>
