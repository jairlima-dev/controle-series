<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
</head>
<body>
<div id="app">
   <div class="container mx-auto">
        <header class="bg-gray-200 py-4 mb-6 h-20 w-80">
            <h1 class="bg-gray-600 rounded-lg text-white text-2xl py-2 px-4 font-bold">
                Controle Séries
            </h1>
        </header>
        <main class="flex">
            <aside class="bg-gray-50 py-4 px-4 w-1/5">
                <ul>
                    <li class=""><router-link :to="{ name: 'series.index' }" exact>Séries</router-link></li>
                    <li class=""><router-link :to="{ name: 'about' }">About</router-link></li>
                </ul>
            </aside>
            <div class="primary flex-1 py-2 px-2">
                <router-view></router-view>
            </div>
        </main>
    </div>
</div>
<script src="../js/app.js"></script>
</body>
</html>
