import React, {useEffect, useState} from 'react';

function UserList() {
    const [users, setUsers] = useState([]);
    const [nextUrl, setNextUrl] = useState('api/v1/users?page=1&count=6');

    useEffect(() => {
        loadMore();
    }, []);

    const loadMore = async () => {
        const response = await fetch(nextUrl);
        const {data} = await response.json();

        setUsers([...users, ...data.users]);
        setNextUrl(data.links.next_url);
    };

    return (
        <div>
            <h1 className="text-3xl font-bold text-blue-400">Users</h1>

            {users.map(user => (
                <div key={user.id} className="flex items-center gap-3 bg-gray-50 mb-4 p-2 rounded-2xl">
                    <img src={user.photo} alt="" className="w-12 h-12 rounded-full"/>
                    <div className="space-y-1 text-left">
                        <h2 className="text-lg font-semibold">{user.name}</h2>
                        <p className="text-sm text-gray-500">{user.position}</p>
                    </div>
                </div>
            ))}

            {nextUrl &&
                <button onClick={loadMore} className="px-4 py-2 mt-4 bg-blue-500 text-white rounded">Load More</button>}
        </div>
    );
}

export default UserList;
