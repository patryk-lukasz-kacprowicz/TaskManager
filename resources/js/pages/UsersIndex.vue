<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: route('users.index'),
    },
];

const page = usePage();

interface User {
    id: number;
    name: string;
    email: string;
}
interface Props {
    users: User[];
}
const props = defineProps<Props>();

const handleDelete = (id: number) => {
    if (confirm('Do you want to delete a user?')) {
        router.delete(route('users.destroy', { id }))
    }
}
</script>

<template>
    <Head title="Dashboard" />

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
                <Link :href="route('users.create')">
                    <Button>Create new user</Button>
                </Link>
            </div>

            <div class="grid auto-rows-min gap-4 p-4 md:grid-cols-1">
                <Table>
                    <TableCaption>A list of users.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]"> ID </TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead class="text-center"> Action </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="user in props.users" :key="user.id">
                            <TableCell class="font-medium">
                                {{ user.id }}
                            </TableCell>
                            <TableCell>{{ user.name }}</TableCell>
                            <TableCell>{{ user.email }}</TableCell>
                            <TableCell class="text-center space-x-2">
                                <Link :href="route('users.edit', {id: user.id})">
                                    <Button>Edit</Button>
                                </Link>
                                <Button @click="handleDelete(user.id)">Delete</Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
