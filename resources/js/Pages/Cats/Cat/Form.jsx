import React, { useEffect, useState } from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head, useForm } from '@inertiajs/inertia-react';
import { useQuill } from 'react-quilljs';

import 'quill/dist/quill.snow.css'; // Add css for snow theme
import { Inertia } from '@inertiajs/inertia';

export default function Form(props) {
    const { quill, quillRef } = useQuill();
    const [{alt, src}, setImg] = useState({
        src: props.cat?.avatar_path ?? '',
        alt: props.cat?.avatar_path ?? ''
    });

    const { data, setData, post, put, processing, errors, progress } = useForm({
        name: props.cat?.name ?? '',
        description: props.cat?.description ?? '',
        is_active: props.cat?.is_active ?? true,
        breed_id: props.cat?.breed_id ?? '',
        avatar: ''
    });

    useEffect(() => {
        if (quill) {
            data.description && quill.clipboard.dangerouslyPasteHTML(data.description);

            quill.on('text-change', (delta, oldDelta, source) => setData(data => ({ ...data, description: quill.root.innerHTML})));
        }
    }, [quill]);

    const handleSubmit = (e) => {
        e.preventDefault();

        if (props.method === 'save') {
            post(route(props.url), data, {
                forceFormData: true,
            });
        } else {
            // put(route(props.url, props.cat.id));
            Inertia.post(route(props.url, props.cat.id), {
                _method: 'put',
                name: data.name,
                description: data.description,
                is_active: data.is_active,
                breed_id: data.breed_id,
                avatar: data.avatar,
            })
        }
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Cat</h2>}
        >
            <Head title="Create Cat" />
            <div className="py-12">
                <div className="flex flex-col gap-8 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="sm:flex sm:items-center">
                        <div className="sm:flex-auto">
                            <h1 className="text-xl font-semibold text-gray-900">Create Cat</h1>
                            <p className="mt-2 text-sm text-gray-700">
                                A list of all cat breeds showcase.
                            </p>
                        </div>
                        <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <button
                                form="cat-form"
                                type="submit"
                                className="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto disabled:opacity-50"
                                disabled={processing}>
                                Save
                            </button>
                        </div>
                    </div>
                    <form id="cat-form" onSubmit={handleSubmit}>
                        <div className="grid grid-cols-1 mt-6 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div className="col-span-3">
                                <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                                    Cat Name
                                </label>
                                <div className="mt-1 rounded-md shadow-sm">
                                    <input
                                        autoComplete="off"
                                        type="text"
                                        name="name"
                                        id="name"
                                        className={`flex-1 block w-full min-w-0 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ${errors.name && 'border-red-500'}`}
                                        onChange={e => setData('name', e.target.value)}
                                        value={data.name} />
                                </div>
                                {errors.name && <small className="text-red-500">{errors.name}</small>}
                            </div>
                            <div className="col-span-4">
                                <label htmlFor="breed_id" className="block text-sm font-medium text-gray-700">
                                    Breed
                                </label>
                                <select
                                    id="breed_id"
                                    name="breed_id"
                                    className={`flex-1 block w-full min-w-0 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm ${errors.name && 'border-red-500'}`}
                                    onChange={e => setData('breed_id', e.target.value)}
                                    value={data.breed_id}
                                >
                                    <option value={''} disabled>Choose an option</option>
                                    {props.breed.map(({data}) => <option key={data.value} value={data.value}>{data.label}</option>)}
                                </select>
                                {errors.breed_id && <small className="text-red-500">{errors.breed_id}</small>}
                            </div>
                            <div className="col-span-4">
                                <label htmlFor="avatar" className="block text-sm font-medium text-gray-700">
                                    Cat Image
                                </label>

                                <input className="mt-1" type="file" onChange={e => {
                                    // setData('avatar', e.target.files[0]);
                                    setData(data => ({ ...data, avatar: e.target.files[0]}));
                                    setImg({
                                        src: URL.createObjectURL(e.target.files[0]),
                                        alt: e.target.files[0].name
                                    });
                                }} />
                                {src && <img src={src} alt={alt} className="mt-5 w-24 h-24 object-cover rounded-md" />}
                                {errors.avatar && <small className="text-red-500">{errors.avatar}</small>}
                            </div>
                            <div className="col-span-4">
                                <label htmlFor="description" className="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <div className="mt-1">
                                    <div className="h-[300px]">
                                        <div ref={quillRef} />
                                    </div>
                                </div>
                            </div>
                            <div className="col-span-6 mt-5">
                                {errors.description && <small className="text-red-500">{errors.description}</small>}
                            </div>
                            <div className="col-span-4">
                                <label htmlFor="is_active" className="block text-sm font-medium text-gray-700">
                                    Status
                                </label>
                                <select
                                    id="is_active"
                                    name="is_active"
                                    className="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onChange={e => setData('is_active', e.target.value)}
                                    value={data.is_active}
                                >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                {errors.is_active && <small className="text-red-500">{errors.is_active}</small>}
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </Authenticated>
    );
}
