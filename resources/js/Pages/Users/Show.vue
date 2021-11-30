<template>
    <Layout>
        <div class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                <div class="divide-y-2 divide-gray-200">
                    <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                        <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                            Gegevens
                        </h2>
                        <div class="mt-8 grid grid-cols-1 gap-12 sm:grid-cols-2 sm:gap-x-8 sm:gap-y-12 lg:mt-0 lg:col-span-2">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Naam
                                </h3>
                                <dl class="mt-2 text-base text-gray-500">
                                    <div>
                                        <dt class="sr-only">
                                            Name
                                        </dt>
                                        <dd>
                                            {{user.name}}
                                        </dd>
                                    </div>
                                </dl>
                                <Link :href="route('users.edit', user.id)" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                            </div>
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Email
                                </h3>
                                <dl class="mt-2 text-base text-gray-500">
                                    <div>
                                        <dt class="sr-only">
                                            Email
                                        </dt>
                                        <dd>
<!--                                            {{user.email}}-->
                                        </dd>
                                    </div>
                                </dl>
                                <Link :href="route('users.edit', user.id)" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout";

export default {
    name: "Show",
    components:{
        Layout
    },
    props: {
        user: Object,
    }
}
</script>

<style scoped>

</style>
