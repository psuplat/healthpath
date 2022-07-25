
<template>

    <Head title="Practices" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Practice Details - {{ practice.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <Link href="/practices"
                        class="px-4 py-2 border-2 border-red-500 hover:border-red-600 text-red-500 rounded">
                    Back</Link>
                </div>
                <div class="container mx-auto bg-white">
                    <ul class="flex justify-center space-x-2 ">
                        <li :class="tab === 1 ? activeTab : inactiveTab">
                            <button @click="currentTab(1)" class="inline-block px-4 py-2">
                                Practice Details
                            </button>
                        </li>
                        <li :class="tab === 2 ? activeTab : inactiveTab">
                            <button @click="currentTab(2)" class="inline-block px-4 py-2">
                                Employees
                            </button>
                        </li>
                        <li :class="tab === 3 ? activeTab : inactiveTab">
                            <button @click="currentTab(3)" class="inline-block px-4 py-2">
                                Fields of Practice
                            </button>
                        </li>
                    </ul>
                    <div class="p-3 mt-6 bg-white">
                        <div v-if="tab === 1" class="flex">
                            <div class="m-2 p-2 mr-80">
                                <p class="mb-5"><b>Name:</b><br>{{ practice.name }}</p>
                                <p class="mb-5"><b>Email:</b><br>{{ practice.email }}</p>
                                <p class="mb-5"><b>Website URL:</b><br>{{ practice.website_url }}</p>
                            </div>
                            <div class="m-2 p-2">
                                <p class="mb-5"><b>Logo:</b></p>
                                <img :src="logo" class="w-40 h-40" v-if="practice.logo"/>
                                <span v-else class="text-gray-500">no logo</span>
                            </div>
                        </div>
                        <div v-if="tab === 2">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in employees" :key="employee.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{employee.fname}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{employee.lname}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{employee.email}}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{employee.phone}}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="tab === 3">
                            <p v-for="field in fields" :key="field.tag">
                                <label><input type="checkbox" :checked="props.practice_fields.includes(field.id)" :id="'field-'+field.id" :value="field.id" @change="toggleField(field.id, $event)" /> {{field.tag}}</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    practice: Object,
    logo: String,
    employees: Array,
    fields: Array,
    practice_fields: Array,
});

const tab = ref(1);
const currentTab = (tabNumber) => (tab.value = tabNumber);

function toggleField(id, event) {
    if (event.target.checked) {
       Inertia.post(`/practices/${props.practice.id}/assign`,{
            field_id: id
        });
    } else {
        Inertia.post(`/practices/${props.practice.id}/remove`,{
            field_id: id
        });
    }
}

const activeTab = 'inline-flex items-center px-1 pt-1 border-b-2 border-red-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-red-700 transition  duration-150 ease-in-out';
const inactiveTab = 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-900 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';

</script>