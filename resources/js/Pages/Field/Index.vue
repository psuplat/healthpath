
<template>

    <Head title="Practices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fields of Practice
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="addTag" enctype="multipart/form-data" class="flex my-4 py-4">
                    <input type="text" id="tag" name="tag" v-model="form.tag"
                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-l-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded">Add</button>
                </form>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Name</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="field in fields" :key="field.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ field.tag }}</div>
                                            </td>
                                            <td
                                                class="flex space-x-4 px-6 py-4 whitespace-nowrap justify-end text-sm font-medium">
                                                <Link v-if="field.practice_count === 0" :href="`/fields/${field.id}`" method="delete" as="button"
                                                    type="button" class="text-red-600 hover:text-red-900">Delete</Link>
                                                <span v-else class="text-gray-600" title="cannot delete field assigned to practice">Delete</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    tag: null
})

const props = defineProps({
    fields: Array
});

function addTag() {
    form.post('/fields');
    form.tag = null;
}
</script>