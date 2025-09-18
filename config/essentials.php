<?php

declare(strict_types=1);

use NunoMaduro\Essentials\Configurables\AggressivePrefetching;
use NunoMaduro\Essentials\Configurables\AutomaticallyEagerLoadRelationships;
use NunoMaduro\Essentials\Configurables\FakeSleep;
use NunoMaduro\Essentials\Configurables\ForceScheme;
use NunoMaduro\Essentials\Configurables\ImmutableDates;
use NunoMaduro\Essentials\Configurables\PreventStrayRequests;
use NunoMaduro\Essentials\Configurables\ProhibitDestructiveCommands;
use NunoMaduro\Essentials\Configurables\SetDefaultPassword;
use NunoMaduro\Essentials\Configurables\ShouldBeStrict;
use NunoMaduro\Essentials\Configurables\Unguard;

$environment = env('APP_ENV', 'production');

$forceSchemeEnvironments = array_filter(
    array_map('trim', explode(',', (string) env('ESSENTIALS_FORCE_SCHEME_ENVIRONMENTS', 'production,staging')))
);

/*
|--------------------------------------------------------------------------
| Documentación de Essentials
|--------------------------------------------------------------------------
|
| AggressivePrefetching: Habilita el prefetch agresivo para acelerar la experiencia en el frontend.
| AutomaticallyEagerLoadRelationships: Resuelve relaciones automáticamente para evitar consultas N+1.
| FakeSleep: Reemplaza las llamadas a sleep() durante las pruebas para que los tests sean más rápidos y deterministas.
| ForceScheme: Fuerza el esquema HTTPS en los entornos definidos.
| ImmutableDates: Hace que Carbon devuelva instancias inmutables.
| PreventStrayRequests: Bloquea peticiones HTTP reales durante las pruebas.
| ProhibitDestructiveCommands: Evita ejecutar comandos destructivos fuera de entornos seguros.
| SetDefaultPassword: Establece reglas de contraseñas por defecto adaptadas al entorno.
| ShouldBeStrict: Activa el modo estricto en Eloquent (sin lazy loading implícito ni atributos faltantes).
| Unguard: Desprotege los modelos para permitir asignación masiva (desactivado por defecto).
| 'environments': Lista de entornos en los que ForceScheme debe aplicarse.
|
| Todas las opciones pueden sobrescribirse desde variables de entorno con el
| prefijo ESSENTIALS_.
|
*/

return [
    // Prefetch agresivo para acelerar la entrega de datos al navegador.
    AggressivePrefetching::class => (bool) env('ESSENTIALS_AGGRESSIVE_PREFETCHING', $environment !== 'local'),

    // Carga automática de relaciones para reducir N+1 queries.
    AutomaticallyEagerLoadRelationships::class => (bool) env('ESSENTIALS_AUTOMATICALLY_EAGER_LOAD_RELATIONSHIPS', true),

    // Reemplaza sleep() en pruebas para acelerar la suite.
    FakeSleep::class => (bool) env('ESSENTIALS_FAKE_SLEEP', $environment === 'testing' || $environment === 'local'),

    // Fuerza HTTPS sólo cuando el entorno pertenece a la lista configurada.
    ForceScheme::class => (bool) env('ESSENTIALS_FORCE_SCHEME', in_array($environment, $forceSchemeEnvironments, true)),

    'environments' => [
        // Entornos donde se debe forzar el esquema HTTPS.
        ForceScheme::class => $forceSchemeEnvironments,
    ],

    // Devuelve fechas inmutables para prevenir modificaciones accidentales.
    ImmutableDates::class => (bool) env('ESSENTIALS_IMMUTABLE_DATES', true),

    // Evita peticiones reales durante los tests salvo que se fingen explícitamente.
    PreventStrayRequests::class => (bool) env('ESSENTIALS_PREVENT_STRAY_REQUESTS', $environment === 'testing' || $environment === 'local'),

    // Bloquea comandos peligrosos fuera de entornos de desarrollo local.
    ProhibitDestructiveCommands::class => (bool) env('ESSENTIALS_PROHIBIT_DESTRUCTIVE_COMMANDS', $environment !== 'local'),

    // Define reglas de contraseñas seguras por defecto (mínimo 12 caracteres en producción).
    SetDefaultPassword::class => (bool) env('ESSENTIALS_SET_DEFAULT_PASSWORD', true),

    // Obliga a Eloquent a operar en modo estricto.
    ShouldBeStrict::class => (bool) env('ESSENTIALS_SHOULD_BE_STRICT', true),

    // Permite desproteger los modelos para asignación masiva si es necesario.
    Unguard::class => (bool) env('ESSENTIALS_UNGUARD', false),
];
