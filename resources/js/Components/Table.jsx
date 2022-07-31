import Pagination from "@/Components/Pagination";

const Table = ({ tableAction, tableHeader, pagination, children }) => {
    return (
        <div>
            {tableAction}
            <div className="flex flex-col mt-8 ring-1 ring-black ring-opacity-5">
                <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div className="overflow-hidden md:rounded-tl-lg md:rounded-tr-lg">
                            <table className="min-w-full divide-y divide-gray-300">
                                <thead className="bg-gray-50">
                                    {tableHeader}
                                </thead>
                                <tbody className="bg-white divide-y divide-gray-200">
                                    {children}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <Pagination pagination={pagination} />
            </div>
        </div>
    );
}

export default Table;
