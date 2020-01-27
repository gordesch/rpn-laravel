<script>
    Vue.component('slug-check', {
        props: ['id', 'label', 'name', 'shouldexist', 'value'],
        data() {
            return {
                slug: '',
                pending: '',
                exists: '',
                message: '',
                error: '',
                success: '',
            }
        },
        template: `
            <div
                class="form-group has-feedback"
                v-bind:class="{'has-error': error, 'has-success': success}"
            >
                <label :for="id" class="control-label">@{{ label }}</label>
                <input
                    :id="id"
                    :name="name"
                    class="form-control"
                    pattern="[a-z0-9-]+"
                    size="30"
                    title="minuscules, chiffres et tirets uniquement"
                    type="text"
                    maxlength="255"
                    v-model="slug"
                    @input="slugCheck"
                >
                <span class="form-control-feedback">
                    <i
                        class="fa"
                        v-bind:class="{
                            'fa-spinner': pending,
                            'fa-spin': pending,
                            'fa-check': success,
                            'fa-times': error,
                        }"
                    ></i>
                </span>
                <span class="help-block">@{{ message }}</span>
            </div>
        `,
        methods: {
            slugCheck() {
                this.pending = true;
                this.exists = '';
                this.error = false;
                this.success = false;
                this.message = 'Vérification en cours...';
                if (!this.slug) {
                    this.pending = false;
                    this.message = 'Veuillez taper un titre simplifié';
                    return;
                }
                axios
                    .get('/api/admin/slug_exists/' + this.slug)
                    .then((response) => {
                        this.pending = false;
                        if (response.data) {
                            this.exists = true;
                            if (this.shouldexist) {
                                this.error = false;
                                this.success = true;
                                this.message = 'eeee';
                            } else {
                                this.error = true;
                                this.success = false;
                                this.message = 'Ce titre simplifié n\'est pas disponible';
                            }
                        } else {
                            this.exists = false;
                            if (this.shouldexist) {
                                this.error = true;
                                this.success = false;
                                this.message = 'eeee';
                            } else {
                                this.error = false;
                                this.success = true;
                                this.message = 'Ce titre simplifié est disponible';
                            }
                        }
                    })
                    .catch(function (error) {
                        this.exists = '';
                        this.error = false;
                        this.success = false;
                        this.message = 'Veuillez taper un titre simplifié';
                    });
            },
            doExists() {
                if (this.shouldexist) {
                    this.error = false;
                    this.success = true;
                    this.message = 'Correspondance trouvée';
                } else {
                    this.error = true;
                    this.success = false;
                    this.message = 'Ce titre simplifié n\'est pas disponible';
                }
            },
            dontExists() {
                if (this.shouldexist) {
                    this.error = true;
                    this.success = false;
                    this.message = 'Aucune correspondance. ';
                    this.message +=
                        '<a href="{{ route('admin.shows.import.search.create') }}?searched_show='
                        + this.slug
                        + '">Créer ce film</a>';
                } else {
                    this.error = false;
                    this.success = true;
                    this.message = 'Ce titre simplifié est disponible';
                }
            },
        },
        mounted: function () {
            this.slug = this.value;
            this.slugCheck()
        },
    });
</script>
