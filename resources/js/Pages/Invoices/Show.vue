<template>
    <Layout>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ invoice.invoice_name }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    {{ invoice.customer.name }}
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-8">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-5">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Product
                        </dt>
                        <dd v-for="item in invoice.items" :key="item.id" class="mt-1 text-sm text-gray-900">
                            {{ item.title}}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Aantal
                        </dt>
                        <dd v-for="item in invoice.items" :key="item.id" class="mt-1 text-sm text-gray-900">
                            {{ item.quantity }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Prijs p.st.
                        </dt>
                        <dd v-for="item in invoice.items" :key="item.id" class="mt-1 text-sm text-gray-900">
                            {{ item.price }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Vervaldagen Factuur
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ invoice.due_date }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            Totaal Prijs Excl BTW
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                           € {{ invoice.total_price }}
                        </dd>
                    </div>
                </dl>

                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        PDF van Factuur
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <PaperClipIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                                    <span class="ml-2 flex-1 w-0 truncate">
                   {{ invoice.invoice_name }}
                  </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <Link :href="route('invoices.edit', [invoice.id])" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Edit
                                    </Link>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a :href="route('showPDF', [invoice.id])" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Bekijken
                                    </a>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a :href="route('downloadPDF', [invoice.id])" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Download
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            </div>
        </div>




    </Layout>
</template>

<script>
import { PaperClipIcon } from '@heroicons/vue/solid'
import Layout from "../../Shared/Layout"
export default {
    name: "Show",
    components:{
        Layout,
        PaperClipIcon
    },
    props:{
        invoice:Object
    }
}
</script>

<style scoped>

</style>
