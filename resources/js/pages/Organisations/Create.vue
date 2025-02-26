<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { Head, useForm } from '@inertiajs/vue3';

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
        title: 'Create',
        href: '/organisations/create',
    },
];

const form = useForm({
    name: '',
    address: '',
    country: '',
});

const submit = () => {
    form.post('/organisations', {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Create Organisation" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Create Organisation</h1>
            <Button variant="outline" as="a" href="/organisations">
                <ArrowLeftIcon class="mr-2 h-4 w-4" />
                Back to Organisations
            </Button>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>New Organisation</CardTitle>
                <CardDescription>Add a new organisation to your system</CardDescription>
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
                    <Button type="submit" :disabled="form.processing">Save Organisation</Button>
                </CardFooter>
            </form>
        </Card>
    </AppLayout>
</template>
