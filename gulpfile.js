const elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

elixir(mix => {
    mix.sass([
            'front/front.scss',
            'font-awesome-4.6.3/scss/font-awesome.scss',
            'sweetalert.css'
        ],
        'public/css/front.css'
    );
    mix.sass([
            'back/back.scss',
            'font-awesome-4.6.3/scss/font-awesome.scss',
            'sweetalert.css'
        ],
        'public/css/back.css'
    );
});
