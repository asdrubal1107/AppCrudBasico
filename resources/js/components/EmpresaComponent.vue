<template>
    <main class="main">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categorías</h3>
                <button type="button" class="btn btn-info" @click="AbrirModal('empresas', 'registrar')">Nuevo</button>
            </div>
            <div class="card-body p-0">
                <table class="display" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 15%">Nit</th>
                            <th style="width: 15%">Nombre</th>
                            <th style="width: 10%">Celular</th>
                            <th style="width: 10%">Direccion</th>
                            <th style="width: 15%">Servicios</th>
                            <th style="width: 5%">Estado</th>
                            <th style="width: 40%">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="datos in arrayEmpresas" :key="datos.id">
                            <td v-text="datos.nit"></td>
                            <td v-text="datos.nombre"></td>
                            <td v-text="datos.celular"></td>
                            <td v-text="datos.direccion"></td>
                            <td v-text="datos.servicios"></td>
                            <td class="project-state">
                                <div v-if="datos.estado == 1">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                            </td>
                            <td class="project-actions text-right">
                                <a @click="AbrirModal('empresas', 'actualizar', datos)" class="btn btn-info btn-sm" href="#">Editar</a>
                                <div v-if="datos.estado == 0">
                                    <a @click="ActivarEmpresa(datos.id)" class="btn btn-success btn-sm" href="#">Activar</a>
                                </div>
                                <div v-else>
                                    <a @click="DesactivarEmpresa(datos.id)" class="btn btn-danger btn-sm" href="#">Desactivar</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" :class="{'mostrar' : modal}" style="display: none" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" @click="CerrarModal()" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nit</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nit" class="form-control" placeholder="Nit de la empresa"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la empresa"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Celular</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="celular" class="form-control" placeholder="Celular de la empresa"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="direccion" class="form-control" placeholder="Direccion de la empresa"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Servicios</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="servicios" class="form-control" placeholder="Servicios de la empresa"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="CerrarModal()" class="btn btn-secondary">Cerrar</button>
                        <button type="button" @click="RegistrarEmpresa()" v-if="tipoAccion == 1" class="btn btn-primary">Guardar</button>
                        <button type="button" @click="ActualizarEmpresa()" v-if="tipoAccion == 2" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </main>
</template>

<script>
export default {
    data(){
        return{
            id : 0,
            nit : '',
            nombre : '',
            direccion : '',
            celular : '',
            servicios : '',
            condicion : 0,
            arrayEmpresas : [],
            tipoAccion : 0,
            tituloModal : '',
            modal : 0
        }
    },

    methods : {
        ListarEmpresas(){
            let me = this;
            axios.get('/empresas').then(function (response) {
                me.arrayEmpresas = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
            });
        },

        RegistrarEmpresa(){
            let me = this;
            axios.post('/empresas/registrar', {
                'nit' : this.nit,
                'nombre' : this.nombre,
                'celular' : this.celular,
                'direccion' : this.direccion,
                'servicios' : this.servicios
            })
            .then(function (response) {
                me.CerrarModal();
                me.ListarEmpresas();
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
            });
        },

        ActualizarEmpresa(){
            let me = this;
            axios.put('/empresas/actualizar', {
                'id' : this.id,
                'nit' : this.nit,
                'nombre' : this.nombre,
                'celular' : this.celular,
                'direccion' : this.direccion,
                'servicios' : this.servicios
            })
            .then(function (response) {
                me.CerrarModal();
                me.ListarEmpresas();
            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
            });
        },

        ActivarEmpresa(id){
            Swal.fire({
            title: 'Esta segur@ de activar esta empresa?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy segur@!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                let me = this;
                axios.put('/empresas/activar', {
                    'id' : id
                })
                .then(function (response) {
                    me.ListarEmpresas();
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            }
            })
        },

        DesactivarEmpresa(id){
            Swal.fire({
            title: 'Esta segur@ de desactivar esta empresa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy segur@!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                let me = this;
                axios.put('/empresas/desactivar', {
                    'id' : id
                })
                .then(function (response) {
                    me.ListarEmpresas();
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            }
            })
        },

        CerrarModal(){
            this.modal = 0
        },

        AbrirModal(modelo, accion, data){
            switch(modelo){
                case "empresas":{
                    switch(accion){
                        case "registrar" : {
                            this.nit = ''
                            this.nombre = ''
                            this.direccion = ''
                            this.celular = ''
                            this.servicios = ''
                            this.modal = 1
                            this.tituloModal = 'Registrar empresa'
                            this.tipoAccion = 1
                            break;
                        }

                        case "actualizar" : {
                            this.id = data['id']
                            this.nit = data['nit']
                            this.nombre = data['nombre']
                            this.direccion = data['direccion']
                            this.celular = data['celular']
                            this.servicios = data['servicios']
                            this.modal = 1
                            this.tituloModal = 'Actualizar empresa'
                            this.tipoAccion = 2
                            break;
                        }
                    }
                }
            }
        }
    },

    mounted() {
        this.ListarEmpresas();
    }
};
</script>
<style>
    .modal-content{
        position: absolute !important;
        width: 100% !important;
        margin-top: -30% !important;
    }

    .mostrar{
        display: list-item !important;
        background-color: #3c29297a !important;
        opacity: 1 !important;
        /* position: absolute !important; */
    }
</style>