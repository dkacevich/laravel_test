<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite('resources/css/app.css')

</head>
<body class="antialiased">


<body class="bg-gray-200 flex items-center justify-center h-screen">


<div x-data="form()" x-init="init()" class="bg-white p-6 rounded shadow-md w-1/3">
    <form @submit.prevent="submit" class="space-y-4">
        <input type="text" x-model="fields.name" placeholder="Name" class="w-full p-2 border border-gray-300 rounded">
        <input type="email" x-model="fields.email" placeholder="Email"
               class="w-full p-2 border border-gray-300 rounded">
        <input type="text" x-model="fields.phone" placeholder="Phone" class="w-full p-2 border border-gray-300 rounded">

        <select x-model="fields.position_id" class="w-full p-2 border border-gray-300 rounded">
            <option value="">--Please choose an option--</option>
            <template x-for="position in positions">
                <option :value="position.id" x-text="position.name"></option>
            </template>
        </select>

        <input type="file" x-ref="photo" accept="image/jpeg"
               class="w-full p-2 border border-gray-300 rounded">
        <button type="submit" class="w-full p-2 bg-blue-500 text-white rounded">Register</button>
    </form>
</div>


@vite(['resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>


<script>
    function form() {
        return {
            fields: {
                name: '',
                email: '',
                phone: '',
                position_id: '',
            },
            token: '',
            positions: [],
            init() {
                this.fetchToken();
                this.fetchPositions();
            },
            fetchToken() {
                fetch('api/v1/token')
                    .then(response => response.json())
                    .then(({token}) => this.token = token);
            },

            fetchPositions() {
                fetch('api/v1/positions')
                    .then(response => response.json())
                    .then(({positions}) => {
                        return this.positions = positions;
                    });
            },

            submit() {
                this.fetchToken();

                const data = Object.entries(this.fields)
                const formData = new FormData();
                Object.entries(this.fields).forEach(([key, value]) => formData.append(key, value));

                // Append the photo file to the FormData
                formData.append('photo', this.$refs.photo.files[0]);

                fetch('api/v1/users', {
                    method: 'POST',
                    headers: {
                        'Token': `${this.token}`
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => alert(data.message))
                    .catch(error => console.error(error));
            }
        };
    }
</script>

</body>
</html>
