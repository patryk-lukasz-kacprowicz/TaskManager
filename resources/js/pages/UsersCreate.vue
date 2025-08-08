<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create a user',
        href: route('users.create'),
    },
];

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const handleSubmit = () => {
    form.post(route('users.store'))
}
</script>

<template>
    <Head title="Create a user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="grid auto-rows-min gap-4 p-4 md:grid-cols-1">
                <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                    <div class="space-y-2">
                        <Label :for="name">Name</Label>
                        <Input v-model="form.name" type="text" placeholder="Name"></Input>

                        <div class="text-sm text-red-600" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label :for="email">Email</Label>
                        <Input v-model="form.email" type="email" placeholder="Email"></Input>

                        <div class="text-sm text-red-600" v-if="form.errors.email">{{ form.errors.email }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label :for="password">Password</Label>
                        <Input v-model="form.password" type="password" placeholder="Password"></Input>

                        <div class="text-sm text-red-600" v-if="form.errors.password">{{ form.errors.password }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label :for="password_confirmation">Confirm password</Label>
                        <Input v-model="form.password_confirmation" type="password" placeholder="Password"></Input>

                        <div class="text-sm text-red-600" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
                    </div>

                    <Button type="submit" :disabled="form.processing">Add a user</Button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
