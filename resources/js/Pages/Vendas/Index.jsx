import Modal from '@/Components/Modal';
import SaleMap from '@/Components/SaleMap';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import axios from 'axios';
import { useEffect, useState } from 'react';

export default function Index({ auth }) {

    const [sales, setSales] = useState([]);
    const [showModal, setShowModal] = useState(false);
    const [modalData, setModalData] = useState({});

    const [selectedDiretoria, setSelectedDiretoria] = useState('0');
    const [selectedUnidade, setSelectedUnidade] = useState('0');
    const [selectedVendedor, setSelectedVendedor] = useState('0');
    const [selectedDate, setSelectedDate] = useState('0');

    const [diretorias, setDiretorias] = useState([]);
    const [unidades, setUnidades] = useState([]);
    const [vendedores, setVendedores] = useState([]);


    useEffect(() => {
        if (selectedDate === "") {
            setSelectedDate('0');
        }
        
        axios.get(`/api/vendas/${selectedDiretoria}/${selectedUnidade}/${selectedVendedor}/${selectedDate}/filter`).then(response => {
            setSales(response.data);
        })
            .catch((error) => {
                console.log(error);
            });
    }, [selectedDiretoria, selectedUnidade, selectedVendedor, selectedDate]);



    useEffect(() => {
        axios.get('/api/diretorias').then(response => {
            setDiretorias(response.data);
        })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    useEffect(() => {
        if (selectedDiretoria) {
            axios.get(`/api/unidades/${selectedDiretoria}/filter`).then(response => {
                setUnidades(response.data);
            })
                .catch((error) => {
                    console.log(error);
                });
        }
    }, [selectedDiretoria]);

    useEffect(() => {
        if (selectedUnidade) {
            axios.get(`/api/vendedores/${selectedUnidade}/filter`).then(response => {
                setVendedores(response.data);
            })
                .catch((error) => {
                    console.log(error);
                });
        }
    }, [selectedUnidade]);

    const handleDiretoriaChange = (e) => {
        setSelectedDiretoria(e.target.value);
        setSelectedUnidade('0');
        setSelectedVendedor('0');
    }

    const handleUnidadeChange = (e) => {
        setSelectedUnidade(e.target.value);
        setSelectedVendedor('0');
    }

    const handleVendedorChange = (e) => {
        setSelectedVendedor(e.target.value);
    }

    const handleDateChange = (e) => {
        setSelectedDate(e.target.value);
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Tabela de Vendas</h2>}
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
                            <div class="py-2">
                                <div class="flex justify-between">
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Filtros</h2>
                                </div>
                            </div>
                            <form className='flex pb-[40px] items-center justify-between'>
                                
                                <div className='flex gap-6'>
                                    <div>
                                        <p>Diretoria</p>
                                        <select value={selectedDiretoria} onChange={handleDiretoriaChange} class="top-0 w-[150px] right-0 p-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none" name="diretoria-filter" id="diretoria-filter">
                                            <option value="0">Todas</option>
                                            {diretorias.map((diretoria, key) => (
                                                <option key={key} value={diretoria.id}>{diretoria.diretoria}</option>
                                            ))}

                                        </select>
                                    </div>

                                    <div>
                                        <p>Unidade</p>
                                        <select value={selectedUnidade} onChange={handleUnidadeChange} disabled={!selectedDiretoria} class="top-0 w-[150px] right-0 p-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none" name="unidade-filter" id="unidade-filter">
                                            <option value="0">Todas</option>
                                            {unidades.map((unidade, key) => (
                                                <option key={key} value={unidade.id}>{unidade.unidade}</option>
                                            ))}

                                        </select>
                                    </div>

                                    <div>
                                        <p>Vendedor</p>
                                        <select value={selectedVendedor} onChange={handleVendedorChange} disabled={!selectedUnidade} class="top-0 w-[150px] right-0 p-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none" name="vendedor-filter" id="vendedor-filter">
                                            <option value="0">Todos</option>

                                            {vendedores.map((vendedor, key) => (
                                                <option key={key} value={vendedor.id}>{vendedor.name}</option>
                                            ))}

                                        </select>
                                    </div>

                                    <div>
                                        <p>Data</p>
                                        <input value={selectedDate} onChange={handleDateChange} type="date" class="top-0 right-0 p-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none" name="date-filter" id="date-filter" />
                                    </div>
                                </div>

                            </form>

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
                                    {sales.length === 0 ? (
                                        <div className="w-full overflow-hidden shadow-sm sm:rounded-lg">
                                            <div className="p-6 text-gray-900">Nenhuma venda cadastrada</div>
                                        </div>
                                    ) : (sales.map((sale, key) => (
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




