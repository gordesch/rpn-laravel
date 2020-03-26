const mix = require('laravel-mix');
const purgecssPathsCommon = [
  './app/**/*.php',
  './resources/views/vendor/**/*.php'
];
const purgecssPathsPublic = [
  './resources/js/public/**/*.js',
  './resources/views/public/**/*.php',
  './resources/views/components/public/**/*.php',
  './resources/views/livewire/public/**/*.php',
];
const purgecssPathsAdmin = [
  './resources/js/admin/**/*.js',
  './resources/views/admin/**/*.php',
  './resources/views/components/admin/**/*.php',
  './resources/views/livewire/admin/**/*.php',
];
const purgecssPublic = require('@fullhuman/postcss-purgecss')({
  content: [...purgecssPathsCommon, ...purgecssPathsPublic],
  defaultExtractor: content => content.match(/[\w-/.:]+(?<!:)/g) || []
});
const purgecssAdmin = require('@fullhuman/postcss-purgecss')({
  content: [...purgecssPathsCommon, ...purgecssPathsAdmin],
  defaultExtractor: content => content.match(/[\w-/.:]+(?<!:)/g) || []
});

// Public
mix
  .js('resources/js/public/public.js', 'public/js/public.js')
  .postCss(
    'resources/css/public/public.css',
    'public/css/public.css',
    [
      require('tailwindcss')('./tailwind.public.config.js'),
      ...process.env.NODE_ENV === 'production' ? [purgecssPublic] : []
    ]
  );

// Admin
mix
  .js('resources/js/admin/admin.js', 'public/js/admin/admin.js')
  .postCss(
    'resources/css/admin/admin.css',
    'public/css/admin/admin.css',
    [
      require('tailwindcss')('./tailwind.admin.config.js'),
      ...process.env.NODE_ENV === 'production' ? [purgecssAdmin] : []
    ]
  );

// Common
if (mix.inProduction()) {
  mix.version();
}

