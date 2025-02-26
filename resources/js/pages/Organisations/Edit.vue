<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { Head, useForm } from '@inertiajs/vue3';

interface Organisation {
    id: number;
    name: string;
    address: string | null;
    country: string | null;
}

const props = defineProps<{
    organisation: Organisation;
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
        title: 'Edit',
        href: `/organisations/${props.organisation.id}/edit`,
    },
];

const form = useForm({
    name: props.organisation.name,
    address: props.organisation.address || '',
    country: props.organisation.country || '',
});

const submit = () => {
    form.put(`/organisations/${props.organisation.id}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Edit Organisation" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Edit Organisation</h1>
            <Button variant="outline" as="a" href="/organisations">
                <ArrowLeftIcon class="mr-2 h-4 w-4" />
                Back to Organisations
            </Button>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>Edit Organisation</CardTitle>
                <CardDescription>Update organisation details</CardDescription>
            </CardHeader>
            <form @submit.prevent="submit">
                <CardContent class="space-y-4">
                    <div class="space-y-2">
                        <Label for="name">Name</Label>
                        <Input id="name" v-model="form.name" required />
                        <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label for="address">Address</Label>
                        <Input id="address" v-model="form.address" />
                        <div v-if="form.errors.address" class="text-sm text-red-500">{{ form.errors.address }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label for="country">Country</Label>
                        <Input id="country" v-model="form.country" />
                        <div v-if="form.errors.country" class="text-sm text-red-500">{{ form.errors.country }}</div>
                    </div>
                </CardContent>
                <CardFooter class="flex justify-end space-x-2">
                    <Button type="button" variant="outline" @click="form.reset()">Reset</Button>
                    <Button type="submit" :disabled="form.processing">Update Organisation</Button>
                </CardFooter>
            </form>
        </Card>
    </AppLayout>
</template>
