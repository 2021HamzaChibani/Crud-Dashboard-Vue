<template>

    <div class="flex">
        <div class="w-64 h-screen">
            <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4 space-y-5">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow" />
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
            <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex px-2 lg:px-0">
                        </div>
                        <div class="flex-1 flex items-center justify-center px-2 lg:ml-6 lg:justify-end">
                            <div class="max-w-lg w-full lg:max-w-xs">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </div>
                                    <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search" type="search" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center lg:hidden">
                            <!-- Mobile menu button -->
                            <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Open main menu</span>
                                <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                                <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
                            </DisclosureButton>
                        </div>
                        <div class="hidden lg:ml-4 lg:flex lg:items-center">
                            <!-- Profile dropdown -->
                            <Menu as="div" class="ml-4 relative flex-shrink-0">
                                <div>
                                    <MenuButton class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Profile</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign out</a>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>

                <DisclosurePanel class="lg:hidden">
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">Tom Cook</div>
                                <div class="text-sm font-medium text-gray-500">tom@example.com</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <DisclosureButton as="a" href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Your Profile</DisclosureButton>
                            <DisclosureButton as="a" href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Settings</DisclosureButton>
                            <DisclosureButton as="a" href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Sign out</DisclosureButton>
                        </div>
                    </div>
                </DisclosurePanel>
            </Disclosure>
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
import { Disclosure,  DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { SearchIcon } from '@heroicons/vue/solid'
import {  MenuIcon, XIcon } from '@heroicons/vue/outline'
import { CalendarIcon, ChartBarIcon, FolderIcon, HomeIcon, InboxIcon, UsersIcon } from '@heroicons/vue/outline'

const navigation = [
    { name: 'Dashboard', icon: HomeIcon, href: '', current: true },
    { name: 'Users', icon: UsersIcon, href: '#', current: false },
    { name: 'Projects', icon: FolderIcon, href: '#', current: false },
    { name: 'Calendar', icon: CalendarIcon, href: '#', current: false },
    { name: 'Documents', icon: InboxIcon, href: '#', current: false },
    { name: 'Reports', icon: ChartBarIcon, href: '#', current: false },
]

export default {
    components: {
        Disclosure,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        MenuIcon,
        SearchIcon,
        XIcon,
    },
    setup() {
        return {
            navigation,
        }
    },
}
</script>
