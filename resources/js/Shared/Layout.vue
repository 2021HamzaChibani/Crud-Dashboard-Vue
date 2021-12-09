<template>
    <div class="flex">
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
        </div>
        <div class="w-full bg-gray-100 h-full">
            <div class="m-40">
                <slot/>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import {  MenuIcon, XIcon } from '@heroicons/vue/outline'
import { CalendarIcon, OfficeBuildingIcon, HomeIcon, InboxIcon, UsersIcon, UserGroupIcon } from '@heroicons/vue/outline'


const navigation = [
    { name: 'Dashboard', icon: HomeIcon, href: route('dashboard.index'), current: true },
    { name: 'Users', icon: UsersIcon, href: route('users.index'), current: false },
    { name: 'Organisatie', icon: OfficeBuildingIcon, href: '#', current: false },
    { name: 'Calendar', icon: CalendarIcon, href: '#', current: false },
    { name: 'Invoices', icon: InboxIcon, href: route('invoices.index'), current: false },
    { name: 'Customers', icon: UserGroupIcon, href: route('customers.index'), current: false },
]

export default {
    components: {
        Link,
        MenuIcon,
        XIcon,
    },
    setup() {
        return {
            navigation,
        }
    },
}
</script>
