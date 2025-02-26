<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { BuildingOfficeIcon, BuildingStorefrontIcon } from '@heroicons/vue/24/outline';
import { BeakerIcon } from '@heroicons/vue/24/solid';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

defineProps<{
    name?: string;
}>();

const modules = [
    {
        title: 'Organisations',
        description: 'Manage your organisations and their details',
        icon: BuildingOfficeIcon,
        href: '/organisations',
        color: 'bg-blue-100 dark:bg-blue-900',
        textColor: 'text-blue-700 dark:text-blue-300',
    },
    {
        title: 'Farming',
        description: 'Manage farming blocks and harvests',
        icon: BuildingStorefrontIcon,
        href: '/farming',
        color: 'bg-green-100 dark:bg-green-900',
        textColor: 'text-green-700 dark:text-green-300',
    },
    {
        title: 'Laboratory',
        description: 'Track samples and test results',
        icon: BeakerIcon,
        href: '/laboratory',
        color: 'bg-purple-100 dark:bg-purple-900',
        textColor: 'text-purple-700 dark:text-purple-300',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <Card v-for="module in modules" :key="module.title" class="overflow-hidden">
                    <CardHeader>
                        <div class="flex items-center gap-2">
                            <div :class="[module.color, 'rounded-md p-2']">
                                <component :is="module.icon" class="h-5 w-5" :class="module.textColor" />
                            </div>
                            <CardTitle>{{ module.title }}</CardTitle>
                        </div>
                        <CardDescription>{{ module.description }}</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <Link :href="module.href">
                            <Button class="w-full"> Go to {{ module.title }} </Button>
                        </Link>
                    </CardContent>
                </Card>
            </div>
            <div class="relative min-h-[50vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <h2 class="text-xl font-semibold">Welcome to SteviaSphere</h2>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Your farming, factory, and laboratory operations management system</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
