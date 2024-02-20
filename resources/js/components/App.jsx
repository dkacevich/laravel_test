import {createRoot} from "react-dom/client";
import React, {useState} from "react";
import UserList from "./UserList.jsx";
import Form from "./Form.jsx";
import TabButton from "./TabButton.jsx";

export default function App() {
    const [activeTab, setActiveTab] = useState('UserList');

    return (
        <div className={'container text-center flex-col items-center'}>
            <div className={'inline-flex gap-2 p-4 bg-gray-100 mb-5 rounded'}>
                <TabButton active={activeTab === 'Form'} onClick={() => setActiveTab('Form')}>Register Form</TabButton>
                <TabButton active={activeTab === 'UserList'} onClick={() => setActiveTab('UserList')}>Users</TabButton>
            </div>
            <div className={'w-1/2 mx-auto bg-gray-100 rounded-2xl p-5'}>
                {activeTab === 'UserList' && <UserList/>}
                {activeTab === 'Form' && <Form/>}
            </div>

        </div>
    );
}


if (document.getElementById('app')) {

    const root = createRoot(document.getElementById('app'));
    root.render(<App/>);
}

