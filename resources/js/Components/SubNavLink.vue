<script setup>
import DropdownLink from "@/Components/DropdownLink.vue";
import {computed} from "vue";
import Dropdown from "@/Components/Dropdown.vue";

const props = defineProps({
    subMenuItems: Array,
    active: {
        type: Boolean,
    },
})


const classes = computed(() =>
    props.active
        ? 'inline-flex rounded-md items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'inline-flex rounded-md items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <div :class="classes">
        <!-- Settings Dropdown -->
        <Dropdown align="right" width="48">
            <template #trigger>
            <span>
                <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                >
                    <slot/>

                    <svg
                        class="ml-2 -mr-0.5 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </span>

            </template>

            <template #content>
                <div v-for="(item, index) in subMenuItems" :key="index">
                    <DropdownLink :href="item.route"> {{ item.name }}</DropdownLink>
                </div>
            </template>
        </Dropdown>
    </div>
</template>

