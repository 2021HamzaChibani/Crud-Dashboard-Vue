<template>
    <Layout>
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Use a permanent address where you can receive mail.
                    </p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form  @submit.prevent="createUser" method="post">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                <input v-model="form.name" type="text" name="first_name" id="first_name" autocomplete="given-name" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input  v-model="form.email" type="text" name="email_address" id="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input v-model="form.password" type="password" name="password" id="password" autocomplete="password" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
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
    </Layout>

</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3'
import Layout from "../../Shared/Layout";

export default {
    components:{Layout},

    props:['users'],

    setup(props){

        const form = useForm({
            _method: 'post',
            name:'',
            email:'',
            password:'',
        })

        const createUser = () => {
            form.post(route("users.store"));
        };

        return{ form, createUser }

    },

}
</script>

<style scoped>

</style>
