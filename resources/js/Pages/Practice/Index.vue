
<template>

    <Head title="Practices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Practices
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link href="/practices/create" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Create New</Link>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Website URL</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employees No.</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="practice in practices.data" :key="practice.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10" >
                                                        <img class="h-10 w-10 border-transparent" :src="practice.logo" alt="" v-if="practice.logo"/>
                                                    </div>
                                                    <div class="ml-4 text-sm text-gray-900">{{practice.name}}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{practice.email}}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{practice.website_url}}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{practice.employees_count}}</div>
                                            </td>
                                            <td class="flex space-x-4 px-6 py-4 whitespace-nowrap justify-end text-sm font-medium">
                                                <Link :href="`/practices/${practice.id}`" class="text-green-600 hover:text-green-900">Details</Link>
                                                <Link :href="`/practices/${practice.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                                                <Link :href="`/practices/${practice.id}`" method="delete" as="button" type="button" class="text-red-600 hover:text-red-900">Delete</Link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-6 text-right text-gray-500">
                                <template v-for="link in practices.links">
                                    <Link v-if="link.url" :href="link.url" v-html="link.label" class="px-1" />
                                </template>
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
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    practices: Object
});
</script>