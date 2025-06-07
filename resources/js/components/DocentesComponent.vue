<template>
  <section class="content p-3">
  <div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regDocente">
     <i class="bi bi-person-add"></i> Agregar Docente
    </button>

    <!-- Modal -->
    <div class="modal fade" id="regDocente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registre Un Nuevo Docente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
            <p>
              Por favor complete todos los campos requeridos marcado con (*) 
            </p>
          </div>
          <form class="modal-body mb-3 mt-2" @submit.prevent="crearDocente">
            
            <!---formulario-->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="nombre" class="form-label">Nombres (*) </label>
                      <input type="text" v-model="form.nombre" class="form-control" id="nombre">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="apellido1" class="form-label">Apellidos (*) </label>
                      <input type="text"  v-model="form.apellidos" class="form-control" id="apellido1">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="dir1" class="form-label">Dirección (*) </label>
                      <input type="text" v-model="form.direccion" class="form-control" id="dir1">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="tel1" class="form-label">Teléfono (*) </label>
                      <input type="text" v-model="form.telefono" class="form-control" id="tel1">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="email" class="form-label">Correo (*) </label>
                      <input type="email" v-model="form.correo" class="form-control" id="email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="forma" class="form-label">Formación (*) </label>
                      <textarea type="text" v-model="form.formacion" class="form-control" id="forma"></textarea>
                  </div>
                </div>
            <!--end formulario-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

   </div>
    <!--datatables-->
    <div class="container mt-3">
    <table class="table">
      <thead class="bg-warning">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Correo</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Dirección</th>
          <th scope="col">Formacion</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="d,k in docentes" :key="d.id">
          <th scope="row">{{ k+1 }}</th>
          <td>{{ d.nombre }}</td>
          <td>{{ d.apellidos }}</td>
           <td>{{ d.correo }}</td>
          <td>{{ d.telefono }}</td>
          <td>{{ d.direccion }}</td>
          <td>{{ d.formacion }}</td>
          <td>
            <button @click="eliminarDocente(d.id)" class="btn btn-outline-danger btn-sm">Eliminar</button>
            <!--modal-->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-info btn-sm mx-2" :data-toggle="'modal'" :data-target="'#editarDocente' + d.id">
              Editar
            </button>

            <!-- Modal -->
            <div class="modal fade" :id="'editarDocente' + d.id" tabindex="-1" :aria-labelledby="'editarDocente' + d.id" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" :id="'editarDocente' + d.id">Editar Docente: {{ d.nombre }} {{ d.apellidos }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <!--formulario-->
                      <form class="modal-body mb-3 mt-2" @submit.prevent="actualizarDocente(d)">        
                      <!---formulario-->
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombres (*) </label>
                                <input type="text" v-model="d.nombre" class="form-control" id="nombre">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="apellido1" class="form-label">Apellidos (*) </label>
                                <input type="text"  v-model="d.apellidos" class="form-control" id="apellido1">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dir1" class="form-label">Dirección (*) </label>
                                <input type="text" v-model="d.direccion" class="form-control" id="dir1">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tel1" class="form-label">Teléfono (*) </label>
                                <input type="text" v-model="d.telefono" class="form-control" id="tel1">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo (*) </label>
                                <input type="email" v-model="d.correo" class="form-control" id="email">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area" class="form-label">Formacion (*) </label>
                                <textarea v-model="d.formacion" class="form-control" id="area"></textarea>
                            </div>
                          </div>
                      <!--end formulario-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                    </form>
                    <!--end formulario-->    
                </div>
              </div>
            </div>
            <!--end modal-->
          </td>
        </tr>
      </tbody>
    </table>
     </div>
    <!--end datatables-->
   

  </section>
</template>

<script>
import axios from 'axios';
import toastr from 'toastr';

export default {
  
  data() {
    return {
      docentes: [],
      form: {
        nombre: '',
        apellidos: '',
        direccion: '',
        telefono: '',
        correo: '',
        formacion: ''
      }
    };
  },
  mounted() {
    this.cargarDocentes();
  },
  methods: {
    cargarDocentes() { //traer docentes
      axios.get('/api/docentes').then(res => {
        this.docentes = res.data;
      });
    },
    crearDocente() { //crear docentes
      console.log(this.form);
      axios.post('/api/docentes', this.form).then(() => {
        this.form.nombre = '';
        this.form.apellidos = '';
        this.form.direccion = '';
        this.form.telefono = '';
        this.form.correo = '';
        this.form.formacion = '';
        this.cargarDocentes();
        toastr.success('Docente registrado de manera exitosa');
      }).catch(error => {
        toastr.error('Lo sentimos!', error.response.data.error);
      });
    },
    eliminarDocente(id) {
      axios.delete(`/api/docentes/${id}`).then(() => {
        this.cargarDocentes();
        toastr.success('Docente eliminado de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    },
    actualizarDocente(docente){
      axios.put(`/api/docentes/${docente.id}`, docente).then(() => {
        this.cargarDocentes();
        $('#editarDocente' + docente.id).modal('hide');
        toastr.success('Docente actualizado de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    }
  }
};
</script>
