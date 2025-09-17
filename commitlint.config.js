export default {
  extends: ['@commitlint/config-conventional'],
  // Reglas personalizadas (opcional)
  rules: {
    // Ejemplo: hacer que el cuerpo del mensaje sea obligatorio
    // 'body-empty': [2, 'never'],

    // Ejemplo: limitar la longitud del encabezado
    'header-max-length': [2, 'always', 150],

    // Ejemplo: asegurar que el tipo sea uno de los permitidos
    'type-enum': [
      2,
      'always',
      [
        'build', // Cambios que afectan al sistema de construcción o dependencias externas
        'chore', // Cambios en el proceso de construcción o herramientas auxiliares
        'ci', // Cambios en la configuración de CI y scripts
        'docs', // Solo cambios en la documentación
        'feat', // Una nueva característica
        'fix', // Corrección de un error
        'perf', // Cambio que mejora el rendimiento
        'refactor', // Cambio de código que no corrige un error ni añade una característica
        'revert', // Revierte un commit anterior
        'style', // Cambios que no afectan al significado del código (espacios en blanco, formato, etc.)
        'test', // Añadir pruebas faltantes o corregir pruebas existentes
      ],
    ],
  },
};
