<template>
        <layout>
            <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Use a permanent address where you can receive mail.
                    </p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form  @submit.prevent="updateProfileInformation" method="PUT">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                <input v-model="form.name" type="text" name="first_name" id="first_name" autocomplete="given-name" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input  v-model="form.email" type="text" name="email_address" id="email" autocomplete="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input v-model="form.password" type="password" name="password" id="password" autocomplete="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
                            </div>
                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <Link :href="route('users.index')" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Cancel
                                    </Link>
                                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "../../Shared/Layout";
import {useForm} from '@inertiajs/inertia-vue3'

export default {

    components:{Layout},

    props:['user'],

    setup(props){

        const form = useForm({
            _method: 'PUT',
            name:props.user.name,
            email: props.user.email,
            password: props.user.password,
        })

        const updateProfileInformation = ()  => {
            form.post(route('users.update', props.user.id), {
                preserveScroll: true,
            });
        };

        return{ form, updateProfileInformation }

    },

}
</script>

<style scoped>

</style>
