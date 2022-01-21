<template>
    <div class="flex h-screen">
        <div class="w-64 h-screen">
            <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4 space-y-5">
                    <img class="h-8 w-auto" src="../images/dashboard-interface.png" alt="Worrkflow" />
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Dashboard
                    </h3>
                </div>
                <div class="mt-5 flex-grow flex flex-col">
                    <nav class="flex-1 bg-white space-y-1" aria-label="Sidebar">
                        <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-indigo-50 border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-3 py-2 text-sm font-medium border-l-4']">
                            <component :is="item.icon" :class="[item.current ? 'text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
                            {{ item.name }}
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="w-full bg-gray-100  flex flex-col">
            <div class="w-full bg-gray-100">
                <div class="w-full bg-gray-100 h-full">
                    <div class="m-40">
                        <slot/>
                    </div>
                </div>
            </div>

            <!-- Global notification live region, render this permanently at the end of the document -->
            <div aria-live="assertive" class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
                <div class="w-full flex flex-col items-center space-y-4 sm:items-end">
                    <!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->
                    <transition enter-active-class="transform ease-out duration-300 transition" enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                        <div v-if="$page.props.flash.message" class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <CheckCircleIcon class="h-6 w-6 text-green-400" aria-hidden="true" />
                                    </div>
                                    <div class="ml-3 w-0 flex-1 pt-0.5">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $page.props.flash.message }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                        </p>
                                    </div>
                                    <div class="ml-4 flex-shrink-0 flex">
                                        <button @click="$page.props.flash.message = ''" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <span class="sr-only">Close</span>
                                            <XIcon class="h-5 w-5" aria-hidden="true" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import {  MenuIcon, XIcon } from '@heroicons/vue/outline'
import { CalendarIcon, HomeIcon, InboxIcon, UsersIcon, UserGroupIcon, CheckCircleIcon } from '@heroicons/vue/outline'


const navigation = [
    { name: 'Dashboard', icon: HomeIcon, href: route('dashboard.index'), current: true },
    { name: 'Users', icon: UsersIcon, href: route('users.index'), current: false },
    { name: 'Calendar', icon: CalendarIcon, href: '#', current: false },
    { name: 'Invoices', icon: InboxIcon, href: route('invoices.index'), current: false },
    { name: 'Customers', icon: UserGroupIcon, href: route('customers.index'), current: false },
]

export default {
    components: {
        Link,
        MenuIcon,
        XIcon,
        CheckCircleIcon,
        CalendarIcon,
        HomeIcon,
        InboxIcon,
        UsersIcon,
        UserGroupIcon,
    },
    setup() {
        return {
            navigation,
        }
    },
}
</script>
