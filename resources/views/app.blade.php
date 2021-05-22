<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <title>Laravel</title>
</head>
<body>
<div id="app" class="text-lg">
   <div class="container mx-auto">
        <header class="bg-gray-600 text-white py-6 mb-4 h-32 rounded-xl">
            <h1 class="text-4xl py-2 px-6 font-bold">
                Controle Remoto
            </h1>
        </header>
        <main class="flex h-screen pb-6 rounded-sm">
            <aside  class="bg-gray-600  text-white py-4 px-4 w-1/5 rounded-2xl cursor-pointer">
                <div class="buttons flex justify-between mb-4">

                    <div class="button-press ">
                        <router-link :to="{ name: 'series.index' }">
                            <i class="fas fa-power-off text-2xl bg-red-600 w-14 h-14
                            p-3 border-2 border-gray-500 rounded-full"></i>
                            <p class="text-center">Sair</p>
                        </router-link>
                    </div>

                    <div class="button-press">
                        <router-link :to="{ name: 'series.index' }">
                            <i class="fas fa-home text-2xl bg-white text-black w-14 h-14
                            p-3 border-2 border-gray-500 rounded-full"></i>
                            <p class="text-center">Home</p>
                        </router-link>
                    </div>

                </div>

                <hr>

                <p class="text-center m-2">Categorias</p>

                <ul>
                    <router-link :to="{ name: 'series.index' }" exact>
                        <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                            Séries
                        </li>
                    </router-link>

                    <router-link :to="{ name: 'movies.index' }" exact>
                        <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                            Filmes
                        </li>
                    </router-link>

                    <router-link :to="{ name: 'documentaries.index' }" exact>
                        <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                            Documentários
                        </li>
                    </router-link>

                </ul>

                <div class="buttons-circle flex justify-between items-center my-6">
                    <div class="">
                        <i class="fas fa-cog rounded-full bg-white text-black text-2xl
                        h-12 w-12 p-2 px-1 text-gray-800 border-2 hover:border-black text-center"></i>
                    </div>

                    <div class="rounded-full w-23 h-23 p-4 bg-white border-2 hover:border-black">
                        <i class="fas fa-check w-18 h-18 rounded-full bg-white
                        text-green-500 text-3xl h-18 w-18 p-3 border-2 hover:border-gray-400"></i>
                    </div>


                    <div class="rounded-full bg-white text-black h-12 w-12 p-2 border-2 hover:border-black">
                        <i class="fas fa-user text-2xl px-1 text-gray-800"></i>
                    </div>
                </div>

                <ul>
                    <router-link :to="{ name: 'about' }" exact>
                        <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                            About
                        </li>
                    </router-link>

                </ul>

            </aside>
            <div class="primary flex-1 px-2 ml-2">
                <router-view></router-view>
            </div>
        </main>
    </div>
</div>
<script src="../js/app.js"></script>
</body>
</html>
