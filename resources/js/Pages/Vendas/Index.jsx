import Modal from '@/Components/Modal';
import SaleMap from '@/Components/SaleMap';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function Index({ auth }) {

    const { sales } = usePage().props;
    const [showModal, setShowModal] = useState(false);
    const [modalData, setModalData] = useState({});

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <Modal show={showModal}>
                <div className="absolute top-0 right-0 p-4">
                    <button onClick={() => setShowModal(false)} class="text-gray-
                                                        500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div className="p-6">
                    <div className='flex justify-between'>
                        <h2 className="font-semibold text-xl text-gray-800 leading-tight">Detalhes da Venda</h2>
                    </div>
                    <div className='flex justify-between'>
                        <div className="mt-4">
                            <h2>Data da venda: {modalData.created_at}</h2>

                            <p>Valor da Venda: R${modalData.valor}</p>
                            <p>Vendedor: {modalData.username}</p>
                            <p>Unidade: {modalData.unidade}</p>
                            <p>Diretoria: {modalData.diretoria}</p>
                        </div>
                        <div>
                            <p>{modalData.is_roaming == 0 ? "Venda não está em roaming" : "Em Roaming"}</p>
                            <p>Unidade próxima: {modalData.closest_unidade}</p>
                            <SaleMap sale={modalData} />
                        </div>
                    </div>
                </div>
            </Modal>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Data da venda
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            valor da Venda
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Vendedor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Unidade
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Diretoria
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {sales.original.length === 0 ? (
                                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                            <div className="p-6 text-gray-900">Nenhuma venda cadastrada</div>
                                        </div>
                                    ) : (sales.original.map((sale, key) => (
                                        <>
                                            <tr class="bg-white border-b ">
                                                <th scope="row" class="px-6 py-4 font-medium">
                                                    {sale.created_at}
                                                </th>
                                                <td class="px-6 py-4">
                                                    R${sale.valor}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {sale.username}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {sale.unidade}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {sale.diretoria}
                                                </td>
                                                <td class="px-6 py-4">
                                                    <button onClick={() => {
                                                        setModalData(sale);
                                                        setShowModal(true);
                                                    }} class="text-blue-500 hover:text-blue-700">Ver mais detalhes</button>
                                                </td>
                                            </tr>
                                        </>
                                    )))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </AuthenticatedLayout>
    );
}




