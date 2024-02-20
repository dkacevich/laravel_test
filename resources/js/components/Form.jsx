import React, {useEffect, useState} from 'react';

function Form() {
    const [fields, setFields] = useState({
        name: '',
        email: '',
        phone: '',
        position_id: '',
    });
    const [token, setToken] = useState('');
    const [positions, setPositions] = useState([]);
    const [photo, setPhoto] = useState(null);

    useEffect(() => {
        fetchToken();
        fetchPositions();
    }, []);

    const fetchToken = async () => {
        const response = await fetch('api/v1/token');
        const data = await response.json();
        setToken(data.token);
    };

    const fetchPositions = async () => {
        const response = await fetch('api/v1/positions');
        const data = await response.json();
        setPositions(data.positions);
    };

    const submit = async (event) => {
        event.preventDefault();

        const formData = new FormData();
        Object.entries(fields).forEach(([key, value]) => formData.append(key, value));
        formData.append('photo', photo);

        const response = await fetch('api/v1/users', {
            method: 'POST',
            headers: {
                'Token': `${token}`
            },
            body: formData
        });
        const data = await response.json();
        alert(data.message);
    };

    return (
        <form onSubmit={submit} className="space-y-4">
            <input type="text" value={fields.name} onChange={e => setFields({...fields, name: e.target.value})}
                   placeholder="Name" className="w-full p-2 border border-gray-300 rounded"/>
            <input type="email" value={fields.email} onChange={e => setFields({...fields, email: e.target.value})}
                   placeholder="Email" className="w-full p-2 border border-gray-300 rounded"/>
            <input type="text" value={fields.phone} onChange={e => setFields({...fields, phone: e.target.value})}
                   placeholder="Phone" className="w-full p-2 border border-gray-300 rounded"/>
            <select value={fields.position_id} onChange={e => setFields({...fields, position_id: e.target.value})}
                    className="w-full p-2 border border-gray-300 rounded">
                <option value="">--Please choose an option--</option>
                {positions.map(position => (
                    <option key={position.id} value={position.id}>{position.name}</option>
                ))}
            </select>
            <input type="file" accept="image/jpeg" onChange={e => setPhoto(e.target.files[0])}
                   className="w-full p-2 border border-gray-300 rounded"/>
            <button type="submit" className="w-full p-2 bg-blue-500 text-white rounded">Register</button>
        </form>
    );
}

export default Form;
