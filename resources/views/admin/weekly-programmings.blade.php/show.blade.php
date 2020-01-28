@extends('admin.app')

@section('title', "Création d'une fiche-film")

@section('content')

<draggable v-model="myArray">
    <transition-group>
        <div v-for="element in myArray" :key="element.id">
            {{element.name}}
        </div>
    </transition-group>
</draggable>

@endsection

@section('scripts')
@endsection
