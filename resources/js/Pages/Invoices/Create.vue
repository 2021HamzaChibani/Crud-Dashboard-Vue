<template>
    <layout>
        <form  @submit.prevent="createInvoice" method="post">

            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 sm:col-span-3">
                    <label for="client" class="block text-sm font-medium text-gray-700">Customer</label>
                    <select v-model="form.customer_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2" name="client" aria-label="Default select example">
                        <option value="''" disabled selected >Select a Customer</option>
                        <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.name}}</option>
                    </select>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4 md:col-span-3">
                <label for="description" class="block text-sm font-medium text-gray-700">Product</label>
                <input v-model="form.invoice_name" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2"  required autocomplete="description">
            </div>

            <hr class="my-5">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6">
                    <p class="font-medium text-lg">Invoice items</p>
                </div>
                <div v-for="(item, index) in form.items" class="divide-y-2 divide-gray-300 md:divide-none col-span-6 space-y-4" id="invoice_item_container">
                    <div class="col-span-6 grid grid-cols-6 gap-4 py-4 md:py-0" id="invoice_item">
                        <div class="col-span-6 sm:col-span-4 md:col-span-3">
                            <label for="description" class="block text-sm font-medium text-gray-700">Product</label>
                            <input v-model="form.items[index].title" id="title" type="text" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2"  required autocomplete="description">
                        </div>
                        <div class="col-span-6 sm:col-span-2 md:col-span-1">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Aantal</label>
                            <input v-model="form.items[index].quantity" id="quantity" type="number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2"  required autocomplete="quantity">
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <label for="price" class="block text-sm font-medium leading-5 text-gray-700">
                                Prijs p.st.
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm sm:leading-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                                </div>
                                <input v-model="form.items[index].price" id="price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md pl-10 pr-16 " type="text"  placeholder="0.00"  required="required">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm sm:leading-5">
                        Euro
                    </span>
                                </div>
                            </div>
                        </div>
                        <a @click="destroyItem(index)" class="font-medium text-red-600 flex space-x-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="red">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="td-text-red">
                                Delete item
                                </span>
                        </a>
                    </div>
                </div>
                <div class="col-span-6">
                    <a @click="addItem" class="font-medium text-indigo-600 flex space-x-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>
                        Add item
                    </span>
                    </a>
                </div>
            </div>
            <hr class="my-5">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 md:col-span-1">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Vervaldatum</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input v-model="form.due_date" id="due_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md pl-3 pr-16 " type="number" name="due_date" placeholder="0" required="required">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm sm:leading-5">
                            Dagen
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </layout>
</template>

<script>
import InvoiceItem from "../../Shared/InvoiceItem";
import Layout from "../../Shared/Layout";
import {useForm} from "@inertiajs/inertia-vue3";
export default {
    name: "Create",
    components:{
        Layout,
        InvoiceItem,
    },
    props:{
        customers: Array,

    },

    methods: {
        addItem(){
            this.form.items.push({

            });
        },
        destroyItem(index){
                this.form.items.splice(index, 1);
        },
        createInvoice() {
            this.form.post(route("invoices.store"));
        },
    },

    data(){
        return{
            form: this.$inertia.form({
                customer_id: null,
                user_id: null,
                invoice_name:null,
                items: [],
                due_date: 30,

            }),
        }
    },

}
</script>

<style scoped>

</style>
