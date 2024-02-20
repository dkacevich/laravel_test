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


<div x-data="loadMoreData()"
     x-init="init()"
>
    <h1 class="text-3xl font-bold text-blue-400">
        Users
    </h1>
    <template x-for="user in users" :key="user.id">
        <div class="flex items-center space-x-4">
            <img :src="user.photo" alt="" class="w-12 h-12 rounded-full">
            <div class="space-y-1">
                <h2 x-text="user.name" class="text-lg font-semibold"></h2>
                <p x-text="user.position" class="text-sm text-gray-500"></p>
            </div>
        </div>
    </template>
    <button x-show="nextUrl" x-on:click="loadMore()" class="px-4 py-2 bg-blue-500 text-white rounded">Load More
    </button>
</div>


@vite(['resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

<script>


    function loadMoreData() {

        return {
            users: [],
            nextUrl: 'api/v1/users?page=1&count=6',
            loadMore() {
                fetch(this.nextUrl)
                    .then(response => response.json())
                    .then(({data}) => {
                            this.users = [...this.users, ...data.users];
                            this.nextUrl = data.links.next_url;
                        }
                    )
                    .catch(error => console.error(error));
            },
            init() {
                this.loadMore();
            }
        };
    }

</script>

</body>
</html>
