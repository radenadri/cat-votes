import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';
import Table from '@/Components/Table';
import DeleteModal from '@/Components/DeleteModal';

export default function Index(props) {

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Cat</h2>}
        >
            <Head title="Cat" />
            <div className="py-12">
                <div className="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <Table
                        pagination={props.cats}
                        tableAction={
                            <div className="sm:flex sm:items-center">
                                <div className="sm:flex-auto">
                                    <h1 className="text-xl font-semibold text-gray-900">Cat</h1>
                                    <p className="mt-2 text-sm text-gray-700">
                                        A list of all cats showcase.
                                    </p>
                                </div>
                                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                    <a
                                        href={route('cat.create')}
                                        className="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                        Add cat
                                    </a>
                                </div>
                            </div>
                        }
                        tableHeader={
                            <tr>
                                <th scope="col"
                                    className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Name
                                </th>
                                <th scope="col"
                                    className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Owner
                                </th>
                                <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Status
                                </th>
                                <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span className="sr-only">Edit</span>
                                </th>
                            </tr>
                        }>
                        {props.cats.data.map((cat) => (
                            <tr key={cat.id}>
                                <td className="py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div className="flex items-center space-x-2">
                                        {cat.avatar && <img className="w-8 h-8 object-cover rounded-full" src={cat.avatar_path} alt={cat.avatar_path} />}
                                        <span className="font-medium text-gray-900">{cat.name}</span>
                                    </div>
                                </td>
                                <td className="py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <span className="font-medium text-gray-900">{cat.owner.name}</span>
                                </td>
                                <td className="px-3 py-4 text-sm text-gray-500">
                                    <span
                                        className={`inline-flex px-2 text-xs font-semibold leading-5 rounded-full ${cat.is_active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100'}`}>
                                        {cat.is_active ? 'Active' : 'Inactive'}
                                    </span>
                                </td>
                                <td
                                    className="relative py-4 pl-3 pr-4 text-sm font-medium text-right sm:pr-6">
                                    <div className="flex justify-end space-x-4">
                                        <a href={route('cat.edit', cat.id)} className="text-indigo-600 hover:text-indigo-900">
                                            Edit<span className="sr-only">{cat.name}</span>
                                        </a>
                                        <DeleteModal url={'cat.destroy'} id={cat.id} name={cat.name} />
                                    </div>
                                </td>
                            </tr>
                            ))}
                    </Table>
                </div>
            </div>

        </Authenticated>
    );
}
