@extends('admin.app')

@section('title', "Modification d'une fiche-film")

@section('content')

    <form class="form" method="post" action="{{ route('admin.shows.update', [$show]) }}" enctype="multipart/form-data" role="form" style="padding-top:20px">

        @method('PUT')

        @include('admin.shows._form')

        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier la fiche-film">
    </form>
@endsection

@section('scripts')
<script>
    let data = {
        slug: '{{ old('slug', $show->slug) }}',
        exists: 'pending',
    }
    let vm = new Vue({
        el: '#app',
        data: data,
        methods: {
            slugCheck: _.debounce(function() {
                this.pending();
                axios
                    .get('/api/admin/slug_exists/' + data.slug)
                    .then((response) => {
                        data.exists = response.data;
                        if (response.data) {
                            // do exist
                            this.invalid();
                        } else {
                            // don't exist
                            this.valid();
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            }, 600),
            valid() {
                data.exists = false;
                document.querySelector("input[type=submit]").removeAttribute('disabled');
                let el = '';
                el = document.getElementById("ctrlfeedback");
                el.classList.remove('fa-times');
                el.classList.remove('fa-spin');
                el.classList.remove('fa-spinner')
                el.classList.add('fa-check');
                document.getElementById("slugControl").innerHTML = 'Ce titre simplifié est disponible';
                el = document.getElementById("slugControl").parentNode;
                el.classList.remove('has-error')
                el.classList.add('has-success');
            },
            invalid() {
                data.exists = true;
                document.querySelector("input[type=submit]").setAttribute('disabled', true);
                let el = '';
                el = document.getElementById("ctrlfeedback");
                el.classList.remove('fa-check');
                el.classList.remove('fa-spin');
                el.classList.remove('fa-spinner')
                el.classList.add('fa-times');
                document.getElementById("slugControl").innerHTML = 'Ce titre simplifié n\'est pas disponible';
                el = document.getElementById("slugControl").parentNode;
                el.classList.remove('has-success')
                el.classList.add('has-error');
            },
            pending() {
                data.exists = 'pending';
                let el = '';
                el = document.getElementById("ctrlfeedback");
                el.classList.remove('fa-check');
                el.classList.remove('fa-times');
                el.classList.add('fa-spin');
                el.classList.add('fa-spinner')
                document.getElementById("slugControl").innerHTML = 'Vérification en cours...';
                el = document.getElementById("slugControl").parentNode;
                el.classList.remove('has-success')
                el.classList.remove('has-error');
            },
        },
        mounted: function () {
            this.slugCheck()
        },
    })

</script>
@endsection
