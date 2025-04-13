import js from '@eslint/js';
import unusedImports from 'eslint-plugin-unused-imports';
// eslint.config.js
import { globalIgnores } from "eslint/config";
import epv from 'eslint-plugin-vue';

export default [
  js.configs.recommended,
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

  {
    plugins: {
      'unused-imports': unusedImports,
      'vue': epv,
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
  globalIgnores(['vendor/*', 'public/*', 'resources/js/bootstrap.js'])
];

