<template>
    <div class="globalSearchInput">
        <div class="search-input-container">
            <input type="text"
                   placeholder="Search..."
                   v-model.trim="q"
                   @keyup.enter="gotoSearch"
            >
        </div>
        <div class="search-icon-container">
            <i class="material-icons" @click="gotoSearch">search</i>
        </div>
    </div>
</template>
<script>
    document.addEventListener('load', function () {
        let shows = new Bloodhound({
            datumTokenizer: function (show) {
                return Bloodhound.tokenizers.whitespace(show.title);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '/api/admin/shows/for-autocomplete',
            limit: 10
        });

        shows.initialize();

        $('#search-query').typeahead(null, {
            name: 'filmssugg',
            displayKey: 'slug',
            source: films.ttAdapter(),
            templates: {
                empty: [
                    '<p class="empty-message">',
                        'Pas de correspondance',
                    '</p>'
                ].join('\n'),
                suggestion: Handlebars.compile(''+
                    '<p class="tt-filmssugg-entry">' +
                        '<img src="" width="24" height="32" alt="">' +
                        '<strong>@{{title}}</strong> (@{{year}})' +
                    '</p>'
                )
            }
        });
    });
</script>
