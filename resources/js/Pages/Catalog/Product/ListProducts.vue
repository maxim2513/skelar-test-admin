<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {TailwindPagination} from 'laravel-vue-pagination';

defineProps({
    paginatedProduct: {
        type: Object,
    },
    status: {
        type: String,
    },
});
const editProduct = (id) => {

}
const removeProduct = (id) => {

}
const getResults = async (page = 1) => {
    location.assign(route('product.list', {'page': page}));
}

const createNewProduct = () => {
    location.assign(route('product.create'));
}

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <button
                        @click="createNewProduct"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
                    >
                        Create New Product
                    </button>


                    <ul class="border rounded overflow-hidden">
                        <li v-for="product in paginatedProduct.data" :key="product.id" class="border-b last:border-b-0">
                            <div class="p-4 flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-bold">{{ product.name }}</p>
                                    <p class="text-gray-600">ID: {{ product.id }}</p>
                                </div>
                                <div>
                                    <p class="text-xl font-bold">${{ product.price }}</p>
                                    <div class="mt-2">
                                        <button
                                            @click="editProduct(product.id)"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            @click="removeProduct(product.id)"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                        >
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
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