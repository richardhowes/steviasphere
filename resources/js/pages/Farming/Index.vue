<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { BuildingStorefrontIcon } from '@heroicons/vue/24/outline';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Farming',
        href: '/farming',
    },
];
</script>

<template>
    <Head title="Farming" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Farming</h1>
        </div>

        <Card>
            <CardHeader>
                <div class="flex items-center gap-2">
                    <div class="rounded-md bg-green-100 p-2 dark:bg-green-900">
                        <BuildingStorefrontIcon class="h-5 w-5 text-green-700 dark:text-green-300" />
                    </div>
                    <CardTitle>Farming Operations</CardTitle>
                </div>
                <CardDescription>Manage your farming blocks and harvests</CardDescription>
            </CardHeader>
            <CardContent>
                <p class="text-gray-500">This module is under development. Coming soon!</p>
                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>Farming Blocks</CardTitle>
                            <CardDescription>Manage your farming blocks</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Button disabled>View Farming Blocks</Button>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardHeader>
                            <CardTitle>Harvests</CardTitle>
                            <CardDescription>Track your harvests</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Button disabled>View Harvests</Button>
                        </CardContent>
                    </Card>
                </div>
            </CardContent>
        </Card>
    </AppLayout>
</template>
