import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';

export default function Dashboard(props) {
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">All Time</h3>
                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">Breeds Registered</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">{props.breed_total}</dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">Cats Posted</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">{props.cat_total}</dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">Users Registered</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">{props.user_total}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
