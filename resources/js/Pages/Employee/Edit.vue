
<template>

    <Head title="Practices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employees - Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <Link href="/employees" class="px-4 py-2 border-2 border-red-500 hover:border-red-600 text-red-500 rounded">
                    Cancel</Link>
                </div>
                <div class="w-full">
                    <div class="grid mt-10">
                        <form @submit.prevent="updateEmployee" enctype="multipart/form-data" class="bg-white shadow-md m-2 p-2 rounded w-full">
                            <div class="sm:col-span-6">
                                <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                                <div class="mt-1 mb-5">
                                    <input type="text" id="fname" name="fname" v-model="form.fname"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <div class="mt-1 mb-5">
                                    <input type="text" id="lname" name="lname" v-model="form.lname"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1 mb-5">
                                    <input type="email" id="email" name="email" v-model="form.email"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone No.</label>
                                <div class="mt-1 mb-5">
                                    <input type="text" id="phone" name="phone" v-model="form.phone"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                            <div class="sm:col-span-6">
                                <label for="practice_id" class="block text-sm font-medium text-gray-700">Practice</label>
                                <div class="mt-1 mb-5">
                                    <select id="practice_id" name="practice_id" v-model="form.practice_id"
                                        class="block w-full transition duration-150 easy-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
                                        <option  v-for="practice in practices" :key="practice.id" :value="practice.id">{{practice.name}}</option>
                                    </select>
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
    practices: Array,
    employee: Object
});

const form = useForm({
    fname: props.employee.fname,
    lname: props.employee.lname,
    email: props.employee.email,
    phone: props.employee.phone,
    practice_id: props.employee.practice_id,
})

function updateEmployee() {
    Inertia.post(`/employees/${props.employee.id}`,{
        _method: 'put',
        fname: form.fname,
        lname: form.lname,
        email: form.email,
        phone: form.phone,
        practice_id: form.practice_id
    });
}
</script>