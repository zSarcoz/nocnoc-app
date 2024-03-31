<script setup>
import { ref } from "vue";


defineProps({
    collection:{
        type: Array,
        required: true
    }
})

const currentSelection= ref(1)
const selection = ref([])


const handleAddtoSelection = () =>{
    selection.value.push(currentSelection)
}

</script>

<template>
    <select v-model="currentSelection">
        <option v-for="(item,index) in collection" :key="index">{{ item?.name }}</option>
    </select>
<button @click="handleAddtoSelection">Add</button>
    <div>
        <ul>
            <li v-for="(item, index) in selection" :key="index">{{ item?.name }}</li>
        </ul>
    </div>
</template>