<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';

const page = usePage()

interface User {
    id: number,
    name: string,
    email: string,
}
const props = defineProps<{user: User}>()

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: ''
})

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit a user',
        href: route('users.edit', { id: props.user.id }),
    },
];

const handleSubmit = () => {
    form.patch(route('users.update', { id: props.user.id }))
}
</script>

<template>
    <Head title="Edit a user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="grid auto-rows-min gap-4 p-4 md:grid-cols-1">
                <Alert v-if="page.props.flash?.error" class="bg-red-50 text-sm text-red-800 dark:bg-gray-800 dark:text-red-400">
                    <AlertTitle>Error!</AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash.error }}
                    </AlertDescription>
                </Alert>

                <Alert v-if="page.props.flash?.success" class="bg-green-50 text-sm text-green-800 dark:bg-gray-800 dark:text-green-400">
                    <AlertTitle>Great!</AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash.success }}
                    </AlertDescription>
                </Alert>
            </div>

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

                    <Button type="submit" :disabled="form.processing">Edit a user</Button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
