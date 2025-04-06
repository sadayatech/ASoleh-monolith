import js from '@eslint/js';
import unusedImports from 'eslint-plugin-unused-imports';
// eslint.config.js
import {globalIgnores } from "eslint/config";


export default [
  js.configs.recommended,
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
  globalIgnores(["vendor/*", "public/*", "resources/js/bootstrap.js"])
];
