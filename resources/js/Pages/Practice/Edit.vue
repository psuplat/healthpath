
<template>

    <Head title="Practices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Practices - Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <Link href="/practices" class="px-4 py-2 border-2 border-red-500 hover:border-red-600 text-red-500 rounded">
                    Cancel</Link>
                </div>
                <div class="w-full">
                    <div class="grid mt-10">
                        <form @submit.prevent="updatePractice" enctype="multipart/form-data" class="bg-white shadow-md m-2 p-2 rounded w-full">
                            <div class="sm:col-span-6">
                                <div class="flex justify-between">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Name</label>
                                    <div><span class="text-red-700">{{errors.name}}</span></div>
                                </div>
                                <div class="mt-1 mb-5">
                                    <input type="text" id="name" name="name" v-model="form.name"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <div class="flex justify-between">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <div><span class="text-red-700">{{errors.email}}</span></div>
                                </div>
                                <div class="mt-1 mb-5">
                                    <input type="email" id="email" name="email" v-model="form.email"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <label for="website_url" class="block text-sm font-medium text-gray-700">Website URL</label>
                                <div class="mt-1 mb-5">
                                    <input type="text" id="website_url" name="website_url" v-model="form.website_url"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <div class="flex justify-between">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Logo</label>
                                    <div><span class="text-red-700">{{errors.logo}}</span></div>
                                </div>
                                <div class="mt-1 mb-5">
                                    <input type="file" id="logo" name="logo" @input="form.logo = $event.target.files[0]"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                                <div class="m-2 p-2">
                                    <img :src="logo" class="w-20 h-20" v-if="logo"/>
                                </div>
                            </div>
                            <div class="m-2 p-2">
                                <button type="submit"
                                    class="px-4 py-2 bg-green-400 hover:bg-green-600 rounded-lg text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    practice: Object,
    logo: String,
    errors: Array
});

const form = useForm({
    name: props.practice.name,
    email: props.practice.email,
    website_url: props.practice.website_url,
    logo: null,
})

function updatePractice() {
    Inertia.post(`/practices/${props.practice.id}`,{
        _method: 'put',
        name: form.name,
        email: form.email,
        website_url: form.website_url,
        logo: form.logo
    });
}
</script>