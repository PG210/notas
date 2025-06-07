<template>
  <section class="content p-3">
  <div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regEstudiante">
     <i class="bi bi-person-add"></i> Agregar Estudiante
    </button>

    <!-- Modal -->
    <div class="modal fade" id="regEstudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registre Un Nuevo Estudiante</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
            <p>
              Por favor complete todos los campos requeridos marcado con (*) 
            </p>
          </div>
          <form class="modal-body mb-3 mt-2" @submit.prevent="crearEstudiante">
            
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
                      <label for="curso" class="form-label">Curso (*) </label>
                      <input type="text" v-model="form.grado" class="form-control" id="curso">
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
          <th scope="col">Curso</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="e,k in estudiantes" :key="e.id">
          <th scope="row">{{ k+1 }}</th>
          <td>{{ e.nombre }}</td>
          <td>{{ e.apellidos }}</td>
           <td>{{ e.correo }}</td>
          <td>{{ e.telefono }}</td>
          <td>{{ e.direccion }}</td>
          <td>{{ e.grado }}</td>
          <td>
            <button @click="eliminarEstudiante(e.id)" class="btn btn-outline-danger btn-sm">Eliminar</button>
            <!--modal-->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-info btn-sm mx-2" :data-toggle="'modal'" :data-target="'#editarEstudiante' + e.id">
              Editar
            </button>

            <!-- Modal -->
            <div class="modal fade" :id="'editarEstudiante' + e.id" tabindex="-1" :aria-labelledby="'editarEstudiante' + e.id" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" :id="'editarEstudiante' + e.id">Editar Estudiante: {{ e.nombre }} {{ e.apellidos }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <!--formulario-->
                      <form class="modal-body mb-3 mt-2" @submit.prevent="actualizarEstudiante(e)">        
                      <!---formulario-->
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombres (*) </label>
                                <input type="text" v-model="e.nombre" class="form-control" id="nombre">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="apellido1" class="form-label">Apellidos (*) </label>
                                <input type="text"  v-model="e.apellidos" class="form-control" id="apellido1">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dir1" class="form-label">Dirección (*) </label>
                                <input type="text" v-model="e.direccion" class="form-control" id="dir1">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tel1" class="form-label">Teléfono (*) </label>
                                <input type="text" v-model="e.telefono" class="form-control" id="tel1">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo (*) </label>
                                <input type="email" v-model="e.correo" class="form-control" id="email">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="curso" class="form-label">Curso (*) </label>
                                <input type="text" v-model="e.grado" class="form-control" id="curso">
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
      estudiantes: [],
      form: {
        nombre: '',
        apellidos: '',
        direccion: '',
        telefono: '',
        correo: '',
        grado: ''
      }
    };
  },
  mounted() {
    this.cargarEstudiantes();
  },
  methods: {
    cargarEstudiantes() { //traer los estudiantes
      axios.get('/api/estudiantes').then(res => {
        this.estudiantes = res.data;
      });
    },
    crearEstudiante() { //crear estudiante
      console.log(this.form);
      axios.post('/api/estudiantes', this.form).then(() => {
        this.form.nombre = '';
        this.form.apellidos = '';
        this.form.direccion = '';
        this.form.telefono = '';
        this.form.correo = '';
        this.form.grado = '';
        this.cargarEstudiantes();
        //usuario registrao exitosamente
        toastr.success('Estudiante registrado de manera exitosa');
      }).catch(error => {
        console.log(error);
        toastr.error('Lo sentimos!', error);
      });
    },
    eliminarEstudiante(id) {
      axios.delete(`/api/estudiantes/${id}`).then(() => {
        this.cargarEstudiantes();
        toastr.success('Estudiante eliminado de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    },
    actualizarEstudiante(estu){
      axios.put(`/api/estudiantes/${estu.id}`, estu).then(() => {
        this.cargarEstudiantes();
        $('#editarEstudiante' + estu.id).modal('hide');
        toastr.success('Estudiante actualizado de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    }
  }
};
</script>
