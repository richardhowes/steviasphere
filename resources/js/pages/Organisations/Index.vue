<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { EyeIcon, PencilIcon, PlusIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Organisation {
    id: number;
    name: string;
    address: string | null;
    country: string | null;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Organisations',
        href: '/organisations',
    },
];

const props = defineProps<{
    organisations: Organisation[];
}>();

const deleteDialog = ref(false);
const organisationToDelete = ref<Organisation | null>(null);

const confirmDelete = (organisation: Organisation) => {
    organisationToDelete.value = organisation;
    deleteDialog.value = true;
};

const handleDelete = () => {
    if (organisationToDelete.value) {
        router.delete(`/organisations/${organisationToDelete.value.id}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                organisationToDelete.value = null;
            },
        });
    }
};

const cancelDelete = () => {
    deleteDialog.value = false;
    organisationToDelete.value = null;
};
</script>

<template>
    <Head title="Organisations" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Organisations</h1>
            <Link href="/organisations/create">
                <Button>
                    <PlusIcon class="mr-2 h-4 w-4" />
                    Add Organisation
                </Button>
            </Link>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>All Organisations</CardTitle>
                <CardDescription>Manage your organisations and their details</CardDescription>
            </CardHeader>
            <CardContent>
                <Table v-if="organisations.length > 0">
                    <TableHeader>
                        <TableRow>
                            <TableHead>Name</TableHead>
                            <TableHead>Address</TableHead>
                            <TableHead>Country</TableHead>
                            <TableHead class="text-right">Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="organisation in organisations" :key="organisation.id">
                            <TableCell class="font-medium">{{ organisation.name }}</TableCell>
                            <TableCell>{{ organisation.address || 'N/A' }}</TableCell>
                            <TableCell>{{ organisation.country || 'N/A' }}</TableCell>
                            <TableCell class="text-right">
                                <div class="flex justify-end space-x-2">
                                    <Link :href="`/organisations/${organisation.id}`">
                                        <Button variant="ghost" size="icon">
                                            <EyeIcon class="h-4 w-4" />
                                        </Button>
                                    </Link>
                                    <Link :href="`/organisations/${organisation.id}/edit`">
                                        <Button variant="ghost" size="icon">
                                            <PencilIcon class="h-4 w-4" />
                                        </Button>
                                    </Link>
                                    <Button variant="ghost" size="icon" @click="confirmDelete(organisation)">
                                        <TrashIcon class="h-4 w-4" />
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <div v-else class="py-6 text-center">
                    <p class="text-gray-500">No organisations found. Create your first one!</p>
                </div>
            </CardContent>
        </Card>

        <Dialog v-model:open="deleteDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Delete Organisation</DialogTitle>
                    <DialogDescription>
                        Are you sure you want to delete "{{ organisationToDelete?.name }}"? This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="cancelDelete">Cancel</Button>
                    <Button variant="destructive" @click="handleDelete">Delete</Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
