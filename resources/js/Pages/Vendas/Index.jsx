import Modal from '@/Components/Modal';
import SaleMap from '@/Components/SaleMap';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';

export default function Index({ auth }) {

    const { sales } = usePage().props;


    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

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
                                            Detalhes
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
                                            <Modal key={key} show={true}>
                                                <div className="p-6">
                                                    <div className='flex justify-between'>
                                                        <h2 className="font-semibold text-xl text-gray-800 leading-tight">Detalhes da Venda</h2>
                                                        <h2>{sale.created_at}</h2>
                                                    </div>
                                                    <div className='flex justify-between'>
                                                        <div className="mt-4">
                                                            <p>Valor da Venda: R${sale.valor}</p>
                                                            <p>Vendedor: {sale.username}</p>
                                                            <p>Unidade: {sale.unidade}</p>
                                                            <p>Diretoria: {sale.diretoria}</p>
                                                        </div>
                                                        <div>
                                                            <p>{sale.is_roaming == 0 ? "Venda não está em roaming" : "Em Roaming"}</p>
                                                            <p>Unidade próxima: {sale.closest_unidade}</p>
                                                            <SaleMap sale={sale} />
                                                        </div>
                                                    </div>
                                                </div>
                                            </Modal>

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
                                                    Clique para mais detalhes
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




