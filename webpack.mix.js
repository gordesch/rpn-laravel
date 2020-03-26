const mix = require('laravel-mix');

const purgecss = require('@fullhuman/postcss-purgecss')({
  content: [
    './app/**/*.php',
    './resources/**/*.html',
    './resources/**/*.js',
    './resources/**/*.jsx',
    './resources/**/*.ts',
    './resources/**/*.tsx',
    './resources/**/*.php',
    './resources/**/*.vue'
  ],
  defaultExtractor: content => content.match(/[\w-/.:]+(?<!:)/g) || []
});

mix
  .js('resources/js/admin/app.js', 'public/js/admin/app.js');

mix
  .postCss(
    'resources/css/admin/app.css',
    'public/css/admin/app.css',
    [
      require('tailwindcss'),
      ...process.env.NODE_ENV === 'production' ? [purgecss] : []
    ]
  );

if (mix.inProduction()) {
  mix.version();
}

