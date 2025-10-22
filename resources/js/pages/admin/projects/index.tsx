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
                    {projects.data.map((project) => (
                        <div
                            key={project.id}
                            className="border border-sidebar-border/70 p-4 dark:border-sidebar-border"
                        >
                            <h2 className="text-lg font-semibold">
                                {project.title}
                            </h2>
                            <p className="text-sm text-gray-600">
                                {project.description}
                            </p>
                        </div>
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}
