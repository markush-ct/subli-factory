import { projectColumns } from '@/components/app/columns/project';
import { DataTable } from '@/components/app/data-table';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { PaginatedData, Project, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

export default function Index({
    projects,
}: {
    projects: PaginatedData<Project>;
}) {
    console.log(projects);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Team Management" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="relative min-h-[100vh] flex-1 space-y-2 overflow-hidden md:min-h-min">
                    <DataTable columns={projectColumns} data={projects.data} />
                </div>
            </div>
        </AppLayout>
    );
}
