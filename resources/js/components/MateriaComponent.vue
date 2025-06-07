<template>
  <section class="content p-3">
  <div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regMateria">
     <i class="bi bi-person-add"></i> Agregar Asignatura
    </button>

    <!-- Modal -->
    <div class="modal fade" id="regMateria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registre Un Nueva Asignatura</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
            <p>
              Por favor complete todos los campos requeridos marcado con (*) 
            </p>
          </div>
          <form class="modal-body mb-3 mt-2" @submit.prevent="crearAsignatura">
            <!---formulario-->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre (*) </label>
                      <input type="text" v-model="form.nombre" class="form-control" id="nombre">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="dia" class="form-label">Día (*) </label>
                       <select v-model="form.dia" class="form-control" id="dia">
                        <option disabled value="">Seleccione un día</option>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="ini" class="form-label">Hora Inicio (*) </label>
                      <input type="time"  v-model="form.horain" class="form-control" id="ini">
                  </div>
                </div>
                <div class="col-md-6">
                   <div class="mb-3">
                      <label for="fin" class="form-label">Hora Fin (*) </label>
                      <input type="time"  v-model="form.horafin" class="form-control" id="fin">
                   </div>
                </div>
            
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                      <label for="doc" class="form-label">Docente (*) </label>
                        <select v-model="form.docente" class="form-control" id="doc">
                            <option disabled value="" selected>Seleccione un docente</option>
                             <option v-for="d in docentes" :key="d.id" :value="d.id">
                              {{ d.nombre }}
                            </option>
                       </select>
                  </div>
                </div>
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
          <th scope="col">Día</th>
          <th scope="col">H/Inicio</th>
          <th scope="col">H/Final</th>
          <th scope="col">Docente</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="d,k in asignaturas" :key="d.id">
          <th scope="row">{{ k+1 }}</th>
          <td>{{ d.nombre }}</td>
          <td>{{ d.dia }}</td>
           <td>{{ d.horain }}</td>
          <td>{{ d.horafin }}</td>
          <td>{{ d.nomdoc }} {{ d.apellidos }}</td>
          <td>
            <button @click="eliminarAsignatura(d.id)" class="btn btn-outline-danger btn-sm">Eliminar</button>
            <!--modal-->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-info btn-sm mx-2" :data-toggle="'modal'" :data-target="'#editarAsignatura' + d.id">
              Editar
            </button>

            <!-- Modal -->
            <div class="modal fade" :id="'editarAsignatura' + d.id" tabindex="-1" :aria-labelledby="'editarAsignatura' + d.id" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" :id="'editarAsignatura' + d.id">Editar Asignatura: {{ d.nombre }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <!--formulario-->
                    <form class="modal-body mb-3 mt-2" @submit.prevent="actualizarAsignatura(d)">        
                      <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre (*) </label>
                            <input type="text" v-model="d.nombre" class="form-control" id="nombre">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dia" class="form-label">Día (*) </label>
                            <select v-model="d.dia" class="form-control" id="dia">
                                <option disabled value="">Seleccione un día</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ini" class="form-label">Hora Inicio (*) </label>
                            <input type="time" v-model="d.horain" class="form-control" id="ini">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fin" class="form-label">Hora Fin (*) </label>
                            <input type="time"  v-model="d.horafin" class="form-control" id="fin">
                        </div>
                        </div>
                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                            <label for="doc" class="form-label">Docente (*) </label>
                                <select v-model="d.idoc" class="form-control" id="doc">
                                    <option disabled value="" selected>Seleccione un docente</option>
                                    <option v-for="k in docentes" :key="k.id" :value="k.id">
                                    {{ k.nombre }} {{ k.apellidos}} 
                                    </option>
                            </select>
                        </div>
                        </div>
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
      asignaturas: [],
      form: {
        nombre: '',
        dia: '',
        horain: '',
        horafin: '',
        docente: ''
      }
    };
  },
  mounted() {
    this.cargarAsignaturas();
  },
  methods: {
    cargarAsignaturas() { //traer docentes
      axios.get('/api/asignaturas').then(res => {
        this.docentes = res.data.doc;
        this.asignaturas = res.data.asig;
      });
    },
    crearAsignatura() { //crear docentes
      console.log(this.form);
      axios.post('/api/asignaturas', this.form).then(() => {
        this.form.nombre = '';
        this.form.dia = '';
        this.form.horain = '';
        this.form.horafin = '';
        this.form.docente = '';
        this.cargarAsignaturas();
        toastr.success('Asinatura registrada de manera exitosa');
      }).catch(error => {
        toastr.error('Lo sentimos!', error.response.data.error);
      });
    },
    eliminarAsignatura(id) {
      axios.delete(`/api/asignaturas/${id}`).then(() => {
        this.cargarAsignaturas();
        toastr.success('Asignatura eliminado de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    },
    actualizarAsignatura(asignatura){
      axios.put(`/api/asignaturas/${asignatura.id}`, asignatura).then(() => {
        this.cargarAsignaturas();
        $('#editarAsignatura' + asignatura.id).modal('hide');
        toastr.success('Asignatura actualizada de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    }
  }
};
</script>
