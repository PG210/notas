<template>
  <section class="content p-3">
  <div>
    <!-- Button trigger modal -->
    <div class="row">
      <div class="col-md-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regNota">
          <i class="bi bi-person-add"></i> Agregar Nota
        </button>
      </div>
     
    </div>

    <!-- Modal -->
    <div class="modal fade" id="regNota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Notas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
            <p>
              Por favor complete todos los campos requeridos marcado con (*) 
            </p>
          </div>
          <form class="modal-body mb-3 mt-2" @submit.prevent="crearNota">
            
            <!---formulario-->
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="estu" class="form-label">Estudiante (*) </label>
                       <select v-model="form.estudiante" class="form-control" id="estu">
                            <option disabled value="" selected>Seleccione un estudiante</option>
                             <option v-for="e in estudiantes" :key="e.id" :value="e.id">
                              {{ e.nombre }}  {{ e.apellidos }}
                            </option>
                       </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="apellido1" class="form-label">Asignatura (*) </label>
                       <select v-model="form.asignatura" @change="mostrarDocente" class="form-control" id="estu">
                            <option disabled value="" selected>Seleccione una asignatura</option>
                             <option v-for="a in asignaturas" :key="a.id" :value="a.id">
                              {{ a.nombre }}
                            </option>
                       </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="doc" class="form-label">Docente</label>
                      <div v-if="docenteAsignado">
                      <div class="form-control">
                        <span>{{ docenteAsignado.nomdoc }} {{ docenteAsignado.apellidos }}</span>
                      </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                      <label for="per" class="form-label">Periodo (*) </label>
                      <input type="text" v-model="form.periodo" class="form-control" placeholder="Ejemplo. A-2025" id="per">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="mb-3">
                      <label for="nota1" class="form-label">Nota 1 (*) </label>
                      <input type="number" v-model="form.nota1" class="form-control" id="nota1" min="0" max="5">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                      <label for="nota2" class="form-label">Nota 2(*) </label>
                      <input type="number" v-model="form.nota2" class="form-control" id="nota2" min="0" max="5">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                      <label for="nota3" class="form-label">Nota 3(*) </label>
                      <input type="number" v-model="form.nota3" class="form-control" id="nota3" min="0" max="5">
                  </div>
                </div>
                 <div class="col-md-3">
                  <div class="mb-3">
                      <label for="def" class="form-label">Definitiva (promedio)</label>
                      <input type="number" :value="resultado" class="form-control" id="def" readonly>
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
          <th scope="col">Estudiante</th>
          <th scope="col">Asignatura</th>
          <th scope="col">Docente</th>
          <th scope="col">Periodo</th>
          <th scope="col">Nota 1</th>
          <th scope="col">Nota 2</th>
          <th scope="col">Nota 3</th>
          <th scope="col">Definitiva</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="e,k in notas" :key="e.id">
          <th scope="row">{{ k+1 }}</th>
          <td>{{ e.nomestu }} {{ e.apestu }}</td>
          <td>{{ e.asignatura }}</td>
           <td>{{ e.nomdoc }} {{ e.docape }}</td>
          <td>{{ e.periodo }}</td>
          <td>{{ e.nota1 }}</td>
          <td>{{ e.nota2 }}</td>
          <td>{{ e.nota3 }}</td>
          <td>{{ e.calificacion }}</td>
          <td>
            <button @click="eliminarNota(e.idnota)" class="btn btn-outline-danger btn-sm">Eliminar</button>
            <!--modal-->
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
      notas: [],
      docentes: [],
      asignaturas: [],
      docenteAsignado: null,

      form: {
        estudiante: '',
        asignatura: '',
        periodo: '',
        nota1: '',
        nota2: '',
        nota3: ''
      }
    };
  },
  mounted() {
    this.cargarNotas();
  },
  methods: {
    cargarNotas() { //traer los estudiantes, docentes y notas
      axios.get('/api/notas').then(res => {
        this.estudiantes = res.data.estu;
        this.notas = res.data.notas;
        this.docentes = res.data.doc;
        this.asignaturas = res.data.asig;
      });
    },
    crearNota() { //crear estudiante
      console.log(this.form);
      axios.post('/api/notas', this.form).then(() => {
        this.form.estudiante = '';
        this.form.asignatura = '';
        this.form.periodo = '';
        this.form.nota1 = '';
        this.form.nota2 = '';
        this.form.nota3 = '';
        this.cargarNotas();
        //usuario registrao exitosamente
        toastr.success('Nota registrada de manera exitosa');
      }).catch(error => {
        console.log(error);
        toastr.error('Lo sentimos!', error);
      });
    },
    eliminarNota(id) {
      axios.delete(`/api/notas/${id}`).then(() => {
        this.cargarNotas();
        toastr.success('Nota eliminada de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    },
    actualizarNota(nota){
      axios.put(`/api/notas/${nota.idnota}`, nota).then(() => {
        this.cargarNotas();
        $('#editarNota' + estu.id).modal('hide');
        toastr.success('Nota actualizada de manera exitosa');
      }).catch(error => {
         toastr.error('Lo sentimos!', error);
      });
    },
    mostrarDocente() {
      const asignaturaSeleccionada = this.asignaturas.find(a => a.id === this.form.asignatura);
      //console.log('datos', asignaturaSeleccionada);
      if (asignaturaSeleccionada) {
        this.docenteAsignado = asignaturaSeleccionada;
      } else {
        this.docenteAsignado = null;
      }
    },

  },
  //calcular definitiva
  computed:{
    resultado(){
      const nota1 = parseFloat(this.form.nota1) || 0;
      const nota2 = parseFloat(this.form.nota2) || 0;
      const nota3 = parseFloat(this.form.nota3) || 0;
      return ((nota1 + nota2 + nota3) / 3).toFixed(1);
    }
  }
};
</script>