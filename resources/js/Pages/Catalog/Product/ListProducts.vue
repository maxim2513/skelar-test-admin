<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {TailwindPagination} from 'laravel-vue-pagination';
import {router} from "@inertiajs/vue3";
import ProductLine from "@/Pages/Catalog/Product/Partials/ProductLine.vue";

defineProps({
    paginatedProduct: {
        type: Object,
    },
    status: {
        type: String,
    },
});

const getResults = async (page = 1) => {
    let params = route().params;
    params.page = page;
    router.get(route('product.list', params));
}

const createNewProduct = () => {
    router.get(route('product.create'));
}

const applyFilters = () => {
    form.get(route('product.list'))
}

const trashedFilter = route().params.trashed_filter ?? '';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="flex justify-between">
                        <form class="flex space-x-4 items-center">
                            <!-- Search Input -->
                            <div class="flex-grow">
                                <input
                                    name="search"
                                    type="text"
                                    class="w-full border rounded py-2 px-3 focus:outline-none focus:border-blue-500"
                                    placeholder="Search..."
                                    :value="route().params.search ?? ''"
                                />
                            </div>

                            <div>
                                <select v-model="trashedFilter" name="trashed_filter" class="border rounded py-2 px-3 focus:outline-none focus:border-blue-500">
                                    <option value="" >Available Products</option>
                                    <option value="with_trashed">With Trashed</option>
                                    <option value="only_trashed">Only Trashed</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button @click="applyFilters" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Apply
                                </button>
                            </div>
                        </form>
                        <button
                            @click="createNewProduct"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
                        >
                            Create New Product
                        </button>
                    </div>

                    <ul class="border rounded overflow-hidden">
                        <li v-for="product in paginatedProduct.data" :key="product.id" class="border-b last:border-b-0">
                            <ProductLine :product="product"></ProductLine>
                        </li>
                    </ul>

                    <TailwindPagination
                        :data="paginatedProduct"
                        @pagination-change-page="getResults"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>