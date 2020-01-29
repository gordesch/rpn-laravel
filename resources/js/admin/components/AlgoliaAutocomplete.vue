<template>
    <ais-instant-search
        :search-client="searchClient"
        index-name="shows"
    >
        <ais-search-box
            placeholder="Search shows..."
            :class-names="{
                'ais-SearchBox-form': 'form-group',
                'ais-SearchBox-input': 'form-control',
            }"
        ></ais-search-box>

        <ais-hits v-show="currentRefinement"
            :class-names="{
                'ais-Hits': 'open absolute',
            }"
        >
            <ul slot-scope="{ items }" class="dropdown-menu">
                <li v-for="item in items" :key="item.id">
                    <a href="#">{{ item.title }} ({{ item.year }})</a>
                </li>
            </ul>
        </ais-hits>
    </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';

    export default {
        name: "AlgoliaAutocomplete",
        data() {
            return {
                searchClient: algoliasearch(
                    process.env.MIX_ALGOLIA_APP_ID,
                    process.env.MIX_ALGOLIA_SEARCH
                ),
            };
        },
    };
</script>

<style scoped>
    .absolute{
        position: absolute;
    }
</style>
