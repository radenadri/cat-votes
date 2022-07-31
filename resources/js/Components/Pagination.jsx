import { Link } from '@inertiajs/inertia-react';

const Pagination = ({ pagination }) => {

    const getClassName = (active) => {
        if (active) {
            return 'relative z-10 inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 border border-indigo-500 bg-indigo-50';
        }

        return 'relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50';
    }

    return (
        <div className="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 md:rounded-bl-lg md:rounded-br-lg sm:px-6">
            <div className="flex justify-between flex-1 sm:hidden">
                <a href="#"
                    className="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Previous
                </a>
                <a href="#"
                    className="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    Next
                </a>
            </div>
            <div className="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p className="text-sm text-gray-700">
                        Showing <span className="font-medium">{pagination.from}</span> to <span className="font-medium">{pagination.to}</span> of{' '}
                        <span className="font-medium">{pagination.total}</span> results
                    </p>
                </div>
                {pagination.links.length > 3 && (
                    <div>
                        <nav className="relative z-0 inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            {pagination.links.map((link, key) => {
                                return (
                                    link.url === null ?
                                    (<div key={key} className="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-50" dangerouslySetInnerHTML={{__html: link.label}}></div>)
                                    :
                                    (<Link key={key} className={getClassName(link.active)} href={ link.url } dangerouslySetInnerHTML={{__html: link.label}}></Link>)
                                )
                            })}
                        </nav>
                    </div>
                )}
            </div>
        </div>
    );
}

export default Pagination;
