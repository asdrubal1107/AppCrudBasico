@extends('principal')

@section('contenido')
<template v-if="menu == 0">
    <h1>Hola soy el dashboard</h1>
</template>
<template v-if="menu == 1">
    <empresas-component></empresas-component>
</template>
@endsection