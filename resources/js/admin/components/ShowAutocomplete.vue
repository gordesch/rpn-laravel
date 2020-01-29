<template>
    <div class="form-group">
        <label class="control-label">Titre du film</label>
        <input
            type="text"
            @input="onChange"
            v-model="search"
            @keydown.down="onArrowDown"
            @keydown.up="onArrowUp"
            @keydown.enter="onEnter"
            class="form-control"
        >
        <input type="hidden" v-model="result_id" name="result_id">
        <div class="open" style="position: absolute;">
            <ul
                v-show="isOpen"
                class="dropdown-menu"
            >
                <li
                    class="loading"
                    v-if="isLoading"
                >
                    <a>Recherche en cours...</a>
                </li>
                <li
                    v-else
                    v-for="(result, i) in results"
                    :searchKey="i"
                    @click="setResult(result)"
                    class="autocomplete-result"
                    :class="{ 'is-active': i === arrowCounter }"
                >
                    <a href="#">{{ result.title }} ({{ result.year }})</a>
                </li>
                <li
                    class="loading"
                    v-if="!results.length"
                >
                    <a><i class="fa fa-warning"></i> Aucun résultat</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowAutocomplete",
        props: ['searchKey'],
        data() {
            return {
                items: [],
                isOpen: false,
                results: [],
                search: '',
                result_id: '',
                isLoading: false,
                arrowCounter: 0,
            };
        },
        methods: {
            onChange() {
                this.filterResults();
                this.isOpen = true;
            },

            filterResults() {
                // first uncapitalize all the things
                this.results = this.items.filter((item) => {
                    return item.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1;
                }).slice(0, 9);
            },
            setResult(result) {
                this.search = result.title;
                this.result_id = result.id;
                this.isOpen = false;
                // Let's warn the parent that a change was made
                this.$emit('input', this.result_id);
            },
            onArrowDown() {
                if (this.arrowCounter < this.results.length) {
                    this.arrowCounter = this.arrowCounter + 1;
                }
            },
            onArrowUp() {
                if (this.arrowCounter > 0) {
                    this.arrowCounter = this.arrowCounter -1;
                }
            },
            onEnter() {
                this.search = this.results[this.arrowCounter].title;
                this.result_id = this.results[this.arrowCounter].id;
                this.isOpen = false;
                this.arrowCounter = -1;
                // Let's warn the parent that a change was made
                this.$emit('input', this.result_id);
            },
            handleClickOutside(evt) {
                if (!this.$el.contains(evt.target)) {
                    this.isOpen = false;
                    this.arrowCounter = -1;
                }
            }
        },
        mounted() {
            document.addEventListener('click', this.handleClickOutside);
            axios
                .get('/api/admin/shows/for-autocomplete')
                .then((response) => {
                    this.items = response.data;
                });
        },
        destroyed() {
            document.removeEventListener('click', this.handleClickOutside)
        },
    }
</script>

<style scoped>

</style>
