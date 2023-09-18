<script setup>

import {router} from "@inertiajs/vue3";

const props = defineProps({
    product: Object
})

const editProduct = (id) => {
    router.get(route('product.edit', id));
}
const removeProduct = (id) => {
    try {
        router.delete(route('product.delete', id), {
            onBefore: () => confirm('Are you sure you want to delete this Product?'),
        });
    } catch (error) {
        console.error('An error occurred:', error);
    }
}

const forceRemoveProduct = (id) => {
    try {
        router.delete(route('product.delete.force', id), {
            onBefore: () => confirm('Are you sure you want to delete this Product forever?'),
        });
    } catch (error) {
        console.error('An error occurred:', error);
    }
}
const restoreProduct = (id) => {
    router.put(route('product.restore', id))
}


const formatCreatedAt = (createdAt) => {
    const options = {year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric'};
    return new Date(createdAt).toLocaleDateString(undefined, options);
}

</script>

<template>
    <div class="p-4 flex justify-between items-center">
        <div>
            <p class="text-lg font-bold">{{ product.name }}</p>
            <p class="text-gray-600">ID: {{ product.id }}</p>
            <p class="text-gray-600">Created At: {{ formatCreatedAt(product.created_at) }}</p>
            <p v-if="product.deleted_at" class="text-red-600">Trashed</p>
        </div>
        <div>
            <p class="text-xl font-bold">${{ product.price }}</p>
            <div class="mt-2" v-if="!product.deleted_at">
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
            <div class="mt-2" v-if="product.deleted_at">
                <button
                    @click="restoreProduct(product.id)"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2"
                >
                    Restore
                </button>
                <button
                    v-if="product.deleted_at"
                    @click="forceRemoveProduct(product.id)"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                >
                    Force Remove
                </button>
            </div>
        </div>
    </div>
</template>

