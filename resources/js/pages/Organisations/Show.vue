<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ArrowLeftIcon, BuildingOfficeIcon, BuildingStorefrontIcon, PencilIcon } from '@heroicons/vue/24/outline';
import { Head, Link } from '@inertiajs/vue3';

interface Organisation {
    id: number;
    name: string;
    address: string | null;
    country: string | null;
}

interface FarmingBlock {
    id: number;
    name: string;
    block_code: string;
    soil_type: string | null;
}

interface Factory {
    id: number;
    name: string;
    location: string | null;
}

const props = defineProps<{
    organisation: Organisation;
    farmingBlocks: FarmingBlock[];
    factories: Factory[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Organisations',
        href: '/organisations',
    },
    {
        title: props.organisation.name,
        href: `/organisations/${props.organisation.id}`,
    },
];
</script>

<template>
    <Head :title="organisation.name" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">{{ organisation.name }}</h1>
            <div class="flex space-x-2">
                <Button variant="outline" as="a" href="/organisations">
                    <ArrowLeftIcon class="mr-2 h-4 w-4" />
                    Back to Organisations
                </Button>
                <Link :href="`/organisations/${organisation.id}/edit`">
                    <Button>
                        <PencilIcon class="mr-2 h-4 w-4" />
                        Edit
                    </Button>
                </Link>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Organisation Details -->
            <Card class="md:col-span-3">
                <CardHeader>
                    <CardTitle>Organisation Details</CardTitle>
                    <CardDescription>View information about this organisation</CardDescription>
                </CardHeader>
                <CardContent>
                    <dl class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                            <dd class="mt-1 text-sm">{{ organisation.name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</dt>
                            <dd class="mt-1 text-sm">{{ organisation.address || 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Country</dt>
                            <dd class="mt-1 text-sm">{{ organisation.country || 'N/A' }}</dd>
                        </div>
                    </dl>
                </CardContent>
            </Card>

            <!-- Farming Blocks -->
            <Card class="md:col-span-3">
                <CardHeader class="flex flex-row items-center justify-between">
                    <div>
                        <CardTitle class="flex items-center">
                            <BuildingOfficeIcon class="mr-2 h-5 w-5" />
                            Farming Blocks
                        </CardTitle>
                        <CardDescription>Farming blocks associated with this organisation</CardDescription>
                    </div>
                    <Button size="sm" as="a" href="/farming-blocks/create">Add Block</Button>
                </CardHeader>
                <CardContent>
                    <Table v-if="farmingBlocks.length > 0">
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Block Code</TableHead>
                                <TableHead>Soil Type</TableHead>
                                <TableHead class="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="block in farmingBlocks" :key="block.id">
                                <TableCell class="font-medium">{{ block.name }}</TableCell>
                                <TableCell>{{ block.block_code }}</TableCell>
                                <TableCell>{{ block.soil_type || 'N/A' }}</TableCell>
                                <TableCell class="text-right">
                                    <Link :href="`/farming-blocks/${block.id}`">
                                        <Button variant="ghost" size="sm">View</Button>
                                    </Link>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                    <div v-else class="py-6 text-center">
                        <p class="text-gray-500">No farming blocks found for this organisation.</p>
                    </div>
                </CardContent>
            </Card>

            <!-- Factories -->
            <Card class="md:col-span-3">
                <CardHeader class="flex flex-row items-center justify-between">
                    <div>
                        <CardTitle class="flex items-center">
                            <BuildingStorefrontIcon class="mr-2 h-5 w-5" />
                            Factories
                        </CardTitle>
                        <CardDescription>Factories associated with this organisation</CardDescription>
                    </div>
                    <Button size="sm" as="a" href="/factories/create">Add Factory</Button>
                </CardHeader>
                <CardContent>
                    <Table v-if="factories.length > 0">
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Location</TableHead>
                                <TableHead class="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="factory in factories" :key="factory.id">
                                <TableCell class="font-medium">{{ factory.name }}</TableCell>
                                <TableCell>{{ factory.location || 'N/A' }}</TableCell>
                                <TableCell class="text-right">
                                    <Link :href="`/factories/${factory.id}`">
                                        <Button variant="ghost" size="sm">View</Button>
                                    </Link>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                    <div v-else class="py-6 text-center">
                        <p class="text-gray-500">No factories found for this organisation.</p>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
