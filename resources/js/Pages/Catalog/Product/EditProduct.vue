<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps(['product']);


const form = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
});

const submit = () => {
    form.post(route('product.update', props.product.id));
};

const bachToList = () => {
    location.assign(route('product.list'));
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update product: {{ product.id }} </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Name"/>

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="price" value="Price"/>

                            <TextInput
                                id="price"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.price"
                                step="0.01"
                                required
                                autocomplete="price"
                            />

                            <InputError class="mt-2" :message="form.errors.price"/>
                        </div>

                        <div>
                            <InputLabel for="description" value="Description"/>

                            <TextInput
                                id="description"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                required
                                autofocus
                                autocomplete="description"
                            />

                            <InputError class="mt-2" :message="form.errors.description"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <DangerButton type="button" @click="bachToList">
                                Cancel
                            </DangerButton>
                            <PrimaryButton class="ml-4" type="submit" :class="{ 'opacity-25': form.processing }"
                                           :disabled="form.processing">
                                Save
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>