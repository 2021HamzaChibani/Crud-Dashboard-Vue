<template>
    <Layout>
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Gegevens User</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Vul hier u informatie in van uw User.
                    </p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="updateCustomerInformation" method="PUT">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium text-gray-700">Naam </label>
                                <input type="text" v-model="form.name" name="first-name" id="first-name" autocomplete="given-name" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Achternaam</label>
                                <input type="text" v-model="form.lastname" name="last-name" id="last-name" autocomplete="family-name" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" v-model="form.email" name="email-address" id="email-address" autocomplete="email" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="region" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                                <input type="text" v-model="form.password" name="region" id="region" autocomplete="address-level1" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Land</label>
                                <input type="text" v-model="form.country" name="country" id="country"  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="street-address" class="block text-sm font-medium text-gray-700">Straat</label>
                                <input type="text" v-model="form.street" name="street-address" id="street-address" autocomplete="street-address" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="city" class="block text-sm font-medium text-gray-700">Stad</label>
                                <input type="text" v-model="form.city" name="city" id="city" autocomplete="address-level2" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="postal-code" class="block text-sm font-medium text-gray-700">Regio</label>
                                <input type="text" v-model="form.region" name="postal-code" id="postal-code" autocomplete="postal-code" class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="postal-code" class="block text-sm font-medium text-gray-700">Telefoon nummer</label>
                                <input type="text" v-model="form.phone" name="postal-code" id="phone"  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md" />
                            </div>
                            <div class="pt-5">
                                <div class="flex justify-end">

                                    <Link  @click="destroy(customer.id)" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Delete
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
import Layout from "../../Shared/Layout";
import {useForm} from '@inertiajs/inertia-vue3'

export default {

    components:{Layout},

    props:['customer'],

    setup(props){

        const form = useForm({
            _method: 'PUT',
            name:props.customer.name,
            lastname:props.customer.lastname,
            country:props.customer.country,
            street:props.customer.street,
            city:props.customer.city,
            region:props.customer.region,
            phone:props.customer.phone,
            email: props.customer.email,
            password: props.customer.password,
        })

        const updateCustomerInformation = ()  => {
            form.post(route('customers.update', props.customer.id), {
                preserveScroll: true,
            });
        };

        return{ form, updateCustomerInformation }

    },

    methods: {
        destroy(id) {
            this.$inertia.delete(route("customers.destroy", id));
        },
    },


}
</script>

<style scoped>

</style>
