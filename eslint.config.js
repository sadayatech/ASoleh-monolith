import js from '@eslint/js';
import unusedImports from 'eslint-plugin-unused-imports';
import vue from 'eslint-plugin-vue';
import standard from '@vue/eslint-config-standard';
import eslintConfigPrettier from 'eslint-config-prettier/flat';
import { globalIgnores } from 'eslint/config';

export default [
  js.configs.recommended,

  // Vue plugin configuration
  {
    plugins: {
      vue,
    },
    rules: {
      'vue/order-in-components': ['error', {
        order: [
          'el',
          'name',
          'key',
          'parent',
          'functional',
          ['delimiters', 'comments'],
          ['components', 'directives', 'filters'],
          'extends',
          'mixins',
          ['provide', 'inject'],
          'ROUTER_GUARDS',
          'layout',
          'middleware',
          'validate',
          'scrollToTop',
          'transition',
          'loading',
          'inheritAttrs',
          'model',
          ['props', 'propsData'],
          'emits',
          'setup',
          'asyncData',
          'data',
          'fetch',
          'head',
          'computed',
          'watch',
          'watchQuery',
          'LIFECYCLE_HOOKS',
          'methods',
          ['template', 'render'],
          'renderError'
        ]
      }],
      'vue/attributes-order': 'error',
      'vue/no-v-html': 'warn',
      'vue/require-default-prop': 'warn',
      'vue/require-prop-types': 'warn',
    },
  },

  // Standard Vue configuration
  ...standard,

  // Unused imports plugin configuration
  {
    plugins: {
      'unused-imports': unusedImports,
    },
    rules: {
      'unused-imports/no-unused-imports': 'error',
      'unused-imports/no-unused-vars': [
        'warn',
        {
          vars: 'all',
          varsIgnorePattern: '^_',
          args: 'after-used',
          argsIgnorePattern: '^_',
        },
      ],
    },
  },

  // Prettier configuration to disable conflicting rules
  eslintConfigPrettier,

  // File-specific overrides
  {
    files: ['vite.config.js'],
    languageOptions: {
      globals: {
        __dirname: 'readonly',
        require: 'readonly',
        module: 'readonly',
        process: 'readonly',
      },
    },
  },
  {
    files: ['resources/js/app.js'],
    languageOptions: {
      globals: {
        window: 'readonly',
        document: 'readonly',
      },
      sourceType: 'module',
    },
  },

  // Global ignore patterns
  globalIgnores(['vendor/*', 'public/*', 'resources/js/bootstrap.js']),
];
