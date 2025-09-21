<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            'dark-bg': '#0f172a',
                            'dark-card': '#1a202c',
                            'dark-text': '#f3f4f6',
                            'light-bg': '#f3f4f6',
                            'light-card': '#ffffff',
                            'light-text': '#1a202c',
                        },
                    },
                },
            };
        </script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
            body {
                font-family: 'Inter', sans-serif;
                transition:
                    background-color 0.3s,
                    color 0.3s;
            }
            body.dark {
                background-color: #0f172a;
                color: #f3f4f6;
            }
            body.light {
                background-color: #f3f4f6;
                color: #1a202c;
            }
            .text-gradient {
                background-image: linear-gradient(to right, #6ee7b7, #3b82f6, #9333ea);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                color: transparent;
            }
            .card {
                border-radius: 1rem;
                box-shadow:
                    0 4px 6px rgba(0, 0, 0, 0.1),
                    0 10px 20px rgba(0, 0, 0, 0.2);
                transition:
                    transform 0.2s,
                    box-shadow 0.2s;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow:
                    0 8px 12px rgba(0, 0, 0, 0.15),
                    0 20px 40px rgba(0, 0, 0, 0.3);
            }
            .card.dark {
                background-color: #1a202c;
            }
            .card.light {
                background-color: #ffffff;
                box-shadow:
                    0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 20px rgba(0, 0, 0, 0.05);
            }
            .navbar-item {
                transition:
                    color 0.2s,
                    background-color 0.2s;
            }
            .navbar-item:hover {
                color: #ffffff;
                background-color: #3b82f6;
            }
        </style>
    </head>
    <body class="bg-dark-bg text-dark-text">
        <flux:navlist variant="">
            <flux:navlist.group :heading="__('Música')">
                <button
                    id="theme-toggle"
                    class="rounded-full bg-gray-700 p-2 text-gray-200 transition-colors hover:bg-gray-600"
                >
                    <svg
                        id="moon-icon"
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                        ></path>
                    </svg>
                    <svg
                        id="sun-icon"
                        class="hidden h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
                        ></path>
                    </svg>
                </button>
                <a
                    href="#"
                    class="rounded-full bg-gray-700 p-2 text-gray-200 transition-colors hover:bg-gray-600"
                    onclick="showSection('profile-section')"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        ></path>
                    </svg>
                </a>
            </flux:navlist.group>
        </flux:navlist>

        <!-- Contenedor principal de la página -->
        <main class="container mx-auto mt-24 max-w-5xl p-4">
            <header class="mb-12 text-center" id="main-header">
                <h1 class="text-gradient text-4xl font-extrabold tracking-tight md:text-6xl">Tu Centro Musical</h1>
                <p class="mt-4 text-lg text-gray-400 md:text-xl">Selecciona tu plataforma de música para empezar.</p>
            </header>

            <!-- Cuadrícula de tarjetas para las diferentes secciones principales -->
            <section class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4" id="main-section">
                <a
                    href="#"
                    class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                    onclick="showSection('deezer-options-section')"
                >
                    <span class="mb-4 text-6xl" role="img" aria-label="Deezer icon">🎵</span>
                    <h2 class="text-2xl font-bold">Deezer</h2>
                    <p class="mt-2 text-sm text-gray-400">Explora tus listas y artistas favoritos.</p>
                </a>
                <a
                    href="#"
                    class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                    onclick="showSection('lastfm-options-section')"
                >
                    <span class="mb-4 text-6xl" role="img" aria-label="Last.fm icon">🎧</span>
                    <h2 class="text-2xl font-bold">Last.fm</h2>
                    <p class="mt-2 text-sm text-gray-400">Revisa tu historial y descubre nueva música.</p>
                </a>
                <a
                    href="#"
                    class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                    onclick="showSection('spotify-options-section')"
                >
                    <span class="mb-4 text-6xl" role="img" aria-label="Spotify icon">🎶</span>
                    <h2 class="text-2xl font-bold">Spotify</h2>
                    <p class="mt-2 text-sm text-gray-400">Accede a tus playlists y podcasts.</p>
                </a>
                <a
                    href="#"
                    class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                    onclick="showSection('statistics-section')"
                >
                    <span class="mb-4 text-6xl" role="img" aria-label="Statistics icon">📊</span>
                    <h2 class="text-2xl font-bold">Estadísticas</h2>
                    <p class="mt-2 text-sm text-gray-400">Ve tu actividad de música en detalle.</p>
                </a>
            </section>

            <!-- Secciones de opciones para Deezer, Spotify y Last.fm -->
            <section id="deezer-options-section" class="hidden">
                <button
                    onclick="hideSection('deezer-options-section')"
                    class="mb-6 rounded-lg bg-gray-800 px-4 py-2 transition-colors hover:bg-gray-700"
                >
                    ← Atrás
                </button>
                <h2 class="mb-6 text-center text-3xl font-bold">Deezer</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('artist', 'Artista de Ejemplo', 'deezer-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Artists icon">🧑‍🎤</span>
                        <h3 class="text-xl font-bold">Artistas</h3>
                    </a>
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('album', 'Álbum de Prueba', 'deezer-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Albums icon">💿</span>
                        <h3 class="text-xl font-bold">Álbumes</h3>
                    </a>
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('playlist', 'Mi Playlist', 'deezer-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Playlists icon">📝</span>
                        <h3 class="text-xl font-bold">Playlists</h3>
                    </a>
                </div>
            </section>

            <section id="spotify-options-section" class="hidden">
                <button
                    onclick="hideSection('spotify-options-section')"
                    class="mb-6 rounded-lg bg-gray-800 px-4 py-2 transition-colors hover:bg-gray-700"
                >
                    ← Atrás
                </button>
                <h2 class="mb-6 text-center text-3xl font-bold">Spotify</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('artist', 'Artista de Ejemplo', 'spotify-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Artists icon">🧑‍🎤</span>
                        <h3 class="text-xl font-bold">Artistas</h3>
                    </a>
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('album', 'Álbum de Prueba', 'spotify-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Albums icon">💿</span>
                        <h3 class="text-xl font-bold">Álbumes</h3>
                    </a>
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('playlist', 'Mi Playlist', 'spotify-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Playlists icon">📝</span>
                        <h3 class="text-xl font-bold">Playlists</h3>
                    </a>
                </div>
            </section>

            <section id="lastfm-options-section" class="hidden">
                <button
                    onclick="hideSection('lastfm-options-section')"
                    class="mb-6 rounded-lg bg-gray-800 px-4 py-2 transition-colors hover:bg-gray-700"
                >
                    ← Atrás
                </button>
                <h2 class="mb-6 text-center text-3xl font-bold">Last.fm</h2>

                <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('artist', 'Artista de Ejemplo', 'lastfm-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Artists icon">🧑‍🎤</span>
                        <h3 class="text-xl font-bold">Artistas</h3>
                    </a>
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('album', 'Álbum de Prueba', 'lastfm-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Albums icon">💿</span>
                        <h3 class="text-xl font-bold">Álbumes</h3>
                    </a>
                    <a
                        href="#"
                        class="card dark:bg-dark-card light:bg-light-card flex flex-col items-center p-6 text-center"
                        onclick="showDetails('playlist', 'Mi Playlist', 'lastfm-options-section')"
                    >
                        <span class="mb-4 text-6xl" role="img" aria-label="Playlists icon">📝</span>
                        <h3 class="text-xl font-bold">Playlists</h3>
                    </a>
                </div>

                <h3 class="mb-4 text-xl font-bold">Filtros Avanzados</h3>
                <div class="card dark:bg-dark-card light:bg-light-card mb-8 p-6 shadow-lg">
                    <div class="flex flex-col gap-6 md:flex-row md:items-end">
                        <div class="flex-1">
                            <label for="content-type" class="mb-2 block text-gray-400">Tipo de contenido</label>
                            <select
                                id="content-type"
                                class="light:bg-gray-200 light:text-gray-800 w-full rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white"
                            >
                                <option value="artistas">Artistas</option>
                                <option value="albums">Álbumes</option>
                                <option value="playlists">Playlists</option>
                            </select>
                        </div>

                        <div class="flex-1">
                            <label for="time-period" class="mb-2 block text-gray-400">Período de tiempo</label>
                            <select
                                id="time-period"
                                class="light:bg-gray-200 light:text-gray-800 w-full rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white"
                            >
                                <option value="7d">Últimos 7 días</option>
                                <option value="1m">Último mes</option>
                                <option value="6m">Últimos 6 meses</option>
                                <option value="12m">Último año</option>
                                <option value="overall">General</option>
                            </select>
                        </div>

                        <div class="flex-1">
                            <label for="username" class="mb-2 block text-gray-400">Usuario</label>
                            <input
                                type="text"
                                id="username"
                                placeholder="Tu nombre de usuario"
                                class="light:bg-gray-200 light:text-gray-800 w-full rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white"
                            />
                        </div>

                        <button
                            onclick="fetchLastFmResults()"
                            class="mt-4 w-full rounded-lg bg-blue-600 px-6 py-3 font-bold transition-colors hover:bg-blue-700 md:mt-0 md:w-auto"
                        >
                            Mostrar Resultados
                        </button>
                    </div>
                </div>

                <div id="results-table-container" class="mt-8 hidden overflow-x-auto">
                    <h3 class="mb-4 text-xl font-bold">Tabla de Resultados</h3>
                    <table class="w-full table-auto text-left">
                        <thead>
                            <tr class="light:bg-gray-200 rounded-lg dark:bg-gray-800">
                                <th class="rounded-tl-lg p-4">#</th>
                                <th class="p-4">Nombre</th>
                                <th class="p-4">Reproducciones</th>
                                <th class="rounded-tr-lg p-4">Detalles</th>
                            </tr>
                        </thead>
                        <tbody class="light:bg-gray-200 dark:bg-gray-800">
                            <tr class="border-b border-gray-700">
                                <td class="p-4">1</td>
                                <td class="p-4">Artista de Ejemplo</td>
                                <td class="p-4">1,234</td>
                                <td class="p-4">Ver más</td>
                            </tr>
                            <tr class="border-b border-gray-700">
                                <td class="p-4">2</td>
                                <td class="p-4">Álbum de Prueba</td>
                                <td class="p-4">987</td>
                                <td class="p-4">Ver más</td>
                            </tr>
                            <tr class="border-b border-gray-700">
                                <td class="p-4">3</td>
                                <td class="p-4">Mi Playlist</td>
                                <td class="p-4">567</td>
                                <td class="p-4">Ver más</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Sección de Estadísticas, inicialmente oculta -->
            <section id="statistics-section" class="hidden">
                <button
                    onclick="hideSection('statistics-section')"
                    class="mb-6 rounded-lg bg-gray-800 px-4 py-2 transition-colors hover:bg-gray-700"
                >
                    ← Atrás
                </button>
                <h2 class="mb-6 text-center text-3xl font-bold">Estadísticas</h2>
                <div class="card dark:bg-dark-card light:bg-light-card p-6 text-center shadow-lg">
                    <p class="text-gray-400">
                        Esta sección mostrará gráficos y estadísticas detalladas de tu actividad musical.
                    </p>
                </div>
            </section>

            <!-- Sección de Perfil, inicialmente oculta -->
            <section id="profile-section" class="hidden">
                <button
                    onclick="hideSection('profile-section')"
                    class="mb-6 rounded-lg bg-gray-800 px-4 py-2 transition-colors hover:bg-gray-700"
                >
                    ← Atrás
                </button>
                <h2 class="mb-6 text-center text-3xl font-bold">Mi Perfil</h2>
                <div class="card dark:bg-dark-card light:bg-light-card p-6 text-center shadow-lg">
                    <p class="text-gray-400">
                        Aquí se mostrará tu información personal, preferencias de música y otras configuraciones de
                        usuario.
                    </p>
                    <div class="mt-4 rounded-lg border-2 border-dashed border-gray-600 p-4">
                        <p class="text-gray-500 italic">Espacio para la información de perfil...</p>
                    </div>
                </div>
            </section>

            <!-- Sección dinámica para mostrar detalles de artistas, álbumes y playlists -->
            <section id="details-section" class="hidden">
                <button
                    onclick="goBack()"
                    class="mb-6 rounded-lg bg-gray-800 px-4 py-2 transition-colors hover:bg-gray-700"
                    data-parent-section=""
                >
                    ← Atrás
                </button>
                <div class="card dark:bg-dark-card light:bg-light-card p-6 shadow-lg">
                    <div class="flex flex-col items-center gap-6 md:flex-row md:items-start">
                        <img
                            id="details-image"
                            class="h-48 w-48 rounded-lg object-cover"
                            src="https://placehold.co/192x192/4B5563/FFFFFF?text=Imagen"
                            alt="Placeholder image"
                        />
                        <div>
                            <h2 id="details-title" class="mb-2 text-3xl font-bold md:text-4xl"></h2>
                            <p id="details-subtitle" class="mb-4 text-lg text-gray-400"></p>
                            <p id="details-description" class="text-gray-300"></p>
                        </div>
                    </div>
                    <div id="details-related-content" class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Contenido relacionado se insertará aquí dinámicamente -->
                    </div>
                </div>
            </section>
        </main>

        <script>
            // Array de todas las secciones para facilitar la gestión
            const sections = [
                'main-section',
                'deezer-options-section',
                'spotify-options-section',
                'lastfm-options-section',
                'statistics-section',
                'profile-section',
                'details-section',
            ];

            // Oculta todas las secciones y muestra la principal
            function hideAllSections() {
                sections.forEach(sectionId => {
                    const section = document.getElementById(sectionId);
                    if (section) {
                        section.classList.add('hidden');
                    }
                });
                const mainHeader = document.getElementById('main-header');
                if (mainHeader) {
                    mainHeader.classList.remove('hidden');
                }
                const mainSection = document.getElementById('main-section');
                if (mainSection) {
                    mainSection.classList.remove('hidden');
                }
            }

            // Oculta todas las secciones y muestra una específica
            function showSection(sectionId) {
                sections.forEach(section => {
                    document.getElementById(section).classList.add('hidden');
                });
                document.getElementById('main-header').classList.add('hidden');
                document.getElementById(sectionId).classList.remove('hidden');
            }

            // Regresa a la sección principal
            function hideSection(sectionId) {
                document.getElementById(sectionId).classList.add('hidden');
                document.getElementById('main-section').classList.remove('hidden');
                document.getElementById('main-header').classList.remove('hidden');
            }

            // Navegación de vuelta desde la sección de detalles
            function goBack() {
                const parentSectionId = document
                    .querySelector('#details-section button')
                    .getAttribute('data-parent-section');
                if (parentSectionId) {
                    showSection(parentSectionId);
                }
            }

            // Muestra dinámicamente los detalles de un artista, álbum o playlist
            function showDetails(type, name, parentSectionId) {
                // Guarda la sección padre para el botón de "Atrás"
                document.querySelector('#details-section button').setAttribute('data-parent-section', parentSectionId);

                // Define el contenido basado en el tipo
                let title = '';
                let subtitle = '';
                let description = '';
                let image = '';
                let relatedContent = '';

                switch (type) {
                    case 'artist':
                        title = name;
                        subtitle = 'Artista';
                        description =
                            'Este es un artista de ejemplo. Su música abarca varios géneros, desde el rock alternativo hasta la electrónica. Con una carrera de más de 10 años, ha lanzado 5 álbumes de estudio y ha realizado giras mundiales. Su sonido es conocido por sus letras introspectivas y sus melodías pegadizas.';
                        image = `https://placehold.co/192x192/000000/FFFFFF?text=${name.replace(/\s/g, '+')}`;
                        relatedContent = `
                        <h3 class="text-xl font-bold col-span-full mb-4">Álbumes de ${name}</h3>
                        <a href="#" class="card flex flex-col items-center p-4 text-center" onclick="showDetails('album', 'Álbum de Prueba', 'details-section')">
                            <img class="w-full h-auto rounded-lg mb-2" src="https://placehold.co/150x150/4B5563/FFFFFF?text=Album+1" alt="Album Cover">
                            <h4 class="font-bold text-sm">Álbum de Prueba</h4>
                            <p class="text-gray-400 text-xs mt-1">Lanzado en 2023</p>
                        </a>
                        <a href="#" class="card flex flex-col items-center p-4 text-center" onclick="showDetails('album', 'Álbum del Recuerdo', 'details-section')">
                            <img class="w-full h-auto rounded-lg mb-2" src="https://placehold.co/150x150/4B5563/FFFFFF?text=Album+2" alt="Album Cover">
                            <h4 class="font-bold text-sm">Álbum del Recuerdo</h4>
                            <p class="text-gray-400 text-xs mt-1">Lanzado en 2021</p>
                        </a>
                    `;
                        break;
                    case 'album':
                        title = name;
                        subtitle = `Álbum de Artista de Ejemplo`;
                        description =
                            'Este es el álbum más reciente de Artista de Ejemplo, una obra maestra que mezcla ritmos de pop, rock y electrónica. Cada canción cuenta una historia, creando una experiencia auditiva única.';
                        image = `https://placehold.co/192x192/4B5563/FFFFFF?text=${name.replace(/\s/g, '+')}`;
                        relatedContent = `
                        <h3 class="text-xl font-bold col-span-full mb-4">Canciones de ${name}</h3>
                        <a href="#" class="card flex items-center p-4 text-left" onclick="showDetails('song', 'Canción 1', 'details-section')">
                            <span class="mr-4 text-lg">1.</span>
                            <div>
                                <h4 class="font-bold text-lg">Canción 1</h4>
                                <p class="text-gray-400 text-sm">Artista de Ejemplo</p>
                            </div>
                        </a>
                        <a href="#" class="card flex items-center p-4 text-left" onclick="showDetails('song', 'Canción 2', 'details-section')">
                            <span class="mr-4 text-lg">2.</span>
                            <div>
                                <h4 class="font-bold text-lg">Canción 2</h4>
                                <p class="text-gray-400 text-sm">Artista de Ejemplo</p>
                            </div>
                        </a>
                        <a href="#" class="card flex items-center p-4 text-left" onclick="showDetails('song', 'Canción 3', 'details-section')">
                            <span class="mr-4 text-lg">3.</span>
                            <div>
                                <h4 class="font-bold text-lg">Canción 3</h4>
                                <p class="text-gray-400 text-sm">Artista de Ejemplo</p>
                            </div>
                        </a>
                    `;
                        break;
                    case 'playlist':
                        title = name;
                        subtitle = 'Playlist';
                        description =
                            'Una selección curada de canciones para cada estado de ánimo. Incluye una mezcla de géneros y artistas, perfecta para cualquier momento del día.';
                        image = `https://placehold.co/192x192/333333/FFFFFF?text=${name.replace(/\s/g, '+')}`;
                        relatedContent = `
                        <h3 class="text-xl font-bold col-span-full mb-4">Canciones de la Playlist</h3>
                        <a href="#" class="card flex items-center p-4 text-left" onclick="showDetails('song', 'Canción de Playlist 1', 'details-section')">
                            <span class="mr-4 text-lg">1.</span>
                            <div>
                                <h4 class="font-bold text-lg">Canción de Playlist 1</h4>
                                <p class="text-gray-400 text-sm">Artista de Playlist</p>
                            </div>
                        </a>
                        <a href="#" class="card flex items-center p-4 text-left" onclick="showDetails('song', 'Canción de Playlist 2', 'details-section')">
                            <span class="mr-4 text-lg">2.</span>
                            <div>
                                <h4 class="font-bold text-lg">Canción de Playlist 2</h4>
                                <p class="text-gray-400 text-sm">Artista de Playlist</p>
                            </div>
                        </a>
                    `;
                        break;
                    case 'song':
                        title = name;
                        subtitle = 'Canción';
                        description =
                            'Una canción melódica con letras emotivas que evocan una sensación de nostalgia. Es una de las canciones más populares de la discografía del artista y ha sido elogiada por su producción impecable y su estribillo pegadizo.';
                        image = `https://placehold.co/192x192/555555/FFFFFF?text=${name.replace(/\s/g, '+')}`;
                        relatedContent = `
                        <h3 class="text-xl font-bold col-span-full mb-4">Detalles Adicionales</h3>
                        <div class="p-4 rounded-lg bg-gray-700">
                            <p class="text-gray-400"><strong>Álbum:</strong> <a href="#" onclick="showDetails('album', 'Álbum de Prueba', 'details-section')" class="text-blue-400 hover:underline">Álbum de Prueba</a></p>
                            <p class="text-gray-400"><strong>Artista:</strong> <a href="#" onclick="showDetails('artist', 'Artista de Ejemplo', 'details-section')" class="text-blue-400 hover:underline">Artista de Ejemplo</a></p>
                            <p class="text-gray-400"><strong>Duración:</strong> 3:45</p>
                        </div>
                    `;
                        break;
                }

                // Actualiza el contenido de la sección de detalles
                document.getElementById('details-title').innerText = title;
                document.getElementById('details-subtitle').innerText = subtitle;
                document.getElementById('details-description').innerText = description;
                document.getElementById('details-image').src = image;
                document.getElementById('details-image').alt = `Imagen de ${name}`;
                document.getElementById('details-related-content').innerHTML = relatedContent;

                // Oculta todas las secciones existentes y muestra la de detalles
                showSection('details-section');
            }

            // Placeholder para la función de búsqueda de Last.fm
            function fetchLastFmResults() {
                const contentType = document.getElementById('content-type').value;
                const timePeriod = document.getElementById('time-period').value;
                const username = document.getElementById('username').value;

                console.log(`Buscando ${contentType} para el usuario '${username}' en el período '${timePeriod}'.`);

                document.getElementById('results-table-container').classList.remove('hidden');
            }

            // Lógica para el modo oscuro/claro
            const themeToggleBtn = document.getElementById('theme-toggle');
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');

            function setTheme(isDarkMode) {
                const root = document.documentElement;
                const body = document.body;
                const cards = document.querySelectorAll('.card');

                if (isDarkMode) {
                    root.classList.add('dark');
                    body.classList.remove('light');
                    body.classList.add('dark');
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                    cards.forEach(card => {
                        card.classList.remove('light');
                        card.classList.add('dark');
                    });
                } else {
                    root.classList.remove('dark');
                    body.classList.remove('dark');
                    body.classList.add('light');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                    cards.forEach(card => {
                        card.classList.remove('dark');
                        card.classList.add('light');
                    });
                }
            }

            // Cargar el tema guardado en localStorage
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                setTheme(false);
            } else {
                setTheme(true); // Por defecto, es modo oscuro
            }

            themeToggleBtn.addEventListener('click', () => {
                const isDarkMode = document.documentElement.classList.contains('dark');
                const newTheme = !isDarkMode;
                setTheme(newTheme);
                localStorage.setItem('theme', newTheme ? 'dark' : 'light');
            });

            // Asegurar que los cambios de tema se apliquen a los elementos que no estaban al inicio
            const observer = new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                    if (mutation.type === 'childList') {
                        const isDarkMode = document.documentElement.classList.contains('dark');
                        mutation.addedNodes.forEach(node => {
                            if (node.nodeType === 1 && node.classList.contains('card')) {
                                if (isDarkMode) {
                                    node.classList.add('dark');
                                } else {
                                    node.classList.add('light');
                                }
                            }
                        });
                    }
                });
            });

            observer.observe(document.body, { childList: true, subtree: true });
        </script>
    </body>
</html>
