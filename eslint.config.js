import js from '@eslint/js';
import globals from 'globals';

export default [
  {
    // Extender la configuración recomendada
    ...js.configs.recommended,

    // Sobrescribir la regla no-undef para permitir console
    rules: {
      'no-undef': ['error', { typeof: true }],
    },
  },
  {
    // Ignorar directorios específicos
    ignores: ['node_modules/**', 'vendor/**', 'public/**', 'storage/**', 'bootstrap/cache/**'],
  },
  {
    // Configuración para archivos JavaScript/Node (incluye .js, .mjs, .cjs)
    files: ['**/*.{js,mjs,cjs}'],
    languageOptions: {
      ecmaVersion: 2022,
      sourceType: 'module',
      globals: {
        ...globals.browser,
        ...globals.node,
        console: true,
        window: true,
        document: true,
      },
    },
  },
];
