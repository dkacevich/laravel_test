import React from "react";


function TabButton({active, onClick, children}) {
    return (
        <button
            onClick={onClick}
            className={`px-4 py-2 rounded-md ${
                active ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800'
            }`}
        >
            {children}
        </button>
    );
}


export default TabButton
