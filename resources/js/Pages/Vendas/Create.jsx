import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import UserLocationMap from '@/Components/UserLocationMap';

const Create = ({ auth }) => {
    const { data, setData, post, processing, errors, reset } = useForm({
        valor: '',
        vendedor_id: auth.user.id,
        longitude: null,
        latitude: null,
    });

    const [location, setLocation] = useState({ latitude: null, longitude: null });

    const submit = (e) => {
        e.preventDefault();
        data.latitude = location.latitude;
        data.longitude = location.longitude;
        post(route('vendas.store'), data);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Registrar Venda</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12 flex justify-center">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="w-full max-w-sm p-8 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 ">
                            <form className="space-y-6" onSubmit={submit}>
                                <h5 className="text-xl font-medium text-gray-900">Cadastre sua venda</h5>
                                <div>
                                    <label htmlFor="valor" className="block mb-2 text-sm font-medium text-gray-900">Digite o valor da venda</label>
                                    <input type="number" name="valor" id="valor" value={data.valor} onChange={(e) => setData("valor", e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>

                                <input type="hidden" name="latitude" value={data.latitude} />
                                <input type="hidden" name="longitude" value={data.longitude} />

                                <PrimaryButton className="text-white" disabled={processing}>
                                    Cadastrar
                                </PrimaryButton>
                            </form>
                        </div>
                        <UserLocationMap setLocation={setLocation} />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default Create;
