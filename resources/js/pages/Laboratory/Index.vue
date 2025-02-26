<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { BeakerIcon } from '@heroicons/vue/24/solid';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Laboratory',
        href: '/laboratory',
    },
];
</script>

<template>
    <Head title="Laboratory" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Laboratory</h1>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center gap-2">
                    <div class="rounded-md bg-purple-100 p-2 dark:bg-purple-900">
                        <BeakerIcon class="h-5 w-5 text-purple-700 dark:text-purple-300" />
                    </div>
                    <CardTitle>Laboratory Operations</CardTitle>
                </div>
                <CardDescription>Track samples and test results</CardDescription>
            </CardHeader>
            <CardContent>
                <p class="text-gray-500">This module is under development. Coming soon!</p>
                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>Samples</CardTitle>
                            <CardDescription>Manage your samples</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Button disabled>View Samples</Button>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle>Test Results</CardTitle>
                            <CardDescription>Track your test results</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Button disabled>View Test Results</Button>
                        </CardContent>
                    </Card>
                </div>
            </CardContent>
        </Card>
    </AppLayout>
</template>
