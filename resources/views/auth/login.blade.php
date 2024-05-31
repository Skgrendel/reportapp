<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />
    <!-- Favicon -->
    <link rel="icon" href="{{asset('/assets/img/brand/favicon.png')}}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="text-gray-800 antialiased">
    <nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 ">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">

            </div>
            <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden"
                id="example-collapse-navbar">
                <ul class="flex flex-col lg:flex-row list-none mr-auto">
                    <li class="flex items-center">
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <section class="absolute w-full h-full">
            <div class="absolute top-0 w-full h-full bg-gray-900"
                style="background-image: url(./assets/img/register_bg_2.png); background-size: 100%; background-repeat: no-repeat;">
            </div>
            <div class="container mx-auto px-4 h-full">
                <div class="flex content-center items-center justify-center h-full">
                    <div class="w-full lg:w-4/12 px-4">
                        <div
                            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                            <div class="mb-0 px-6 py-6">
                                <div class="mb-3 flex justify-center ">
                                    <x-application-mark class="block h-9 w-auto" />
                                </div>
                                <div class="btn-wrapper text-center">
                                </div>
                                <hr class="mt-6 border-b-1 border-gray-400" />
                            </div>
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <div class="text-gray-500 text-center mb-3 font-bold">

                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">Correo Electronico</label><input type="email"
                                            name="email" value="{{ old('email') }}" required autofocus
                                            class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            placeholder="Email" style="transition: all 0.15s ease 0s;" />
                                    </div>
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            for="grid-password">Contraseña</label><input type="password" name="password"
                                            required
                                            class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            placeholder="Password" style="transition: all 0.15s ease 0s;" />
                                    </div>
                                    <div>
                                        <label class="inline-flex items-center cursor-pointer"><input id="remember_me"
                                                type="checkbox" name="remember"
                                                class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5"
                                                style="transition: all 0.15s ease 0s;" /><span
                                                class="ml-2 text-sm font-semibold text-gray-700">Recuerdame</span></label>
                                    </div>
                                    <div class="text-center mt-6">
                                        <button
                                            class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                            type="submit" style="transition: all 0.15s ease 0s;">
                                            Iniciar Sesion
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="flex flex-wrap mt-6">
                        </div>
                    </div>
                </div>
            </div>
            <footer class="absolute w-full bottom-0 bg-gray-900 pb-6">
                <div class="container mx-auto px-4">
                    <hr class="mb-6 border-b-1 border-gray-700" />
                    <div class="flex flex-wrap items-center md:justify-between justify-center">
                        <div class="w-full md:w-4/12 px-4">
                            <div class="text-sm text-white font-semibold py-1">
                                Copyright © 2024
                                <a href="https://proderi.com/"
                                    class="text-white hover:text-gray-400 text-sm font-semibold py-1">Proderi</a>
                            </div>
                        </div>
                        <div class="w-full md:w-8/12 px-4">

                        </div>
                    </div>
                </div>
            </footer>
        </section>
    </main>
</body>

<script>
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
</script>


   @if (session('error'))
<script>
    Swal.fire({
        title: '¡Alto!',
        text: '{{ session('error') }}',
        icon: 'warning',
        confirmButtonText: 'OK'
    });
</script>
@endif


</html>
