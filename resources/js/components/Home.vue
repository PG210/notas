<template>
  <section class="content p-3">
    <div class="row">
      <div class="col-md-12">
        <div class="card-deck">
          <div class="card">
            <div class="card-body bg-info">
              <h5 class="card-title">Estudiantes</h5>
              <div class="card-text mt-5">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total: {{ estu }} </li>
                    <li class="list-group-item">En curso: {{ estu }}</li>
                    <li class="list-group-item">Retirados: 0</li>
                  </ul>
              </div>
              <div class="card-footer mt-3">
              <p class="card-text  bg-light p-2"><small class="text-muted">
                <router-link to="/estudiantes" class="nav-link">
                  <i class="bi bi-arrow-right-square-fill"></i> Gestionar
                </router-link>
              </small></p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body bg-info">
              <h5 class="card-title">Docentes</h5>
              <div class="card-text mt-5">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total: {{ docentes }}</li>
                    <li class="list-group-item">En curso: {{ docentes }}</li>
                    <li class="list-group-item">Retirados: 0</li>
                  </ul>
              </div>
              <div class="card-footer mt-3">
              <p class="card-text  bg-light p-2"><small class="text-muted">
                <router-link to="/docentes" class="nav-link">
                  <i class="bi bi-arrow-right-square-fill"></i> Gestionar
                </router-link>
              </small></p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body bg-info">
              <h5 class="card-title">Asignaturas</h5>
               <div class="card-text mt-5">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total: {{ asig || 0 }}</li>
                    <li class="list-group-item">Alto promedio: {{ malta }}  <br></li>
                    <li class="list-group-item">Bajo promedio: {{ mbajo }}</li>
                  </ul>
              </div>
              <div class="card-footer mt-3">
              <p class="card-text  bg-light p-2"><small class="text-muted">
                <router-link to="/asignaturas" class="nav-link">
                  <i class="bi bi-arrow-right-square-fill"></i> Gestionar
                </router-link>
              </small></p>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body bg-info">
              <h5 class="card-title">Notas</h5>
              <div class="card-text mt-5">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total: {{ notas.length || 0 }}</li>
                    <li class="list-group-item">Aprobados: {{ aprob.length || 0 }}</li>
                    <li class="list-group-item">Reprobados: {{ rep.length || 0}}</li>
                  </ul>
              </div>
              <div class="card-footer mt-3">
              <p class="card-text bg-light p-2"><small class="text-muted">
                <router-link to="/notas" class="nav-link">
                  <i class="bi bi-arrow-right-square-fill"></i> Gestionar
                </router-link>
              </small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="row">
       <div class="col-md-12"></div>
    </div>
   <div class="content-wrapper">
      <router-view />
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import toastr from 'toastr';

export default {
  
  data() {
    return {
      notas: [],
      aprob: [],
      rep: [],
      asig: [],
      malta: [],
      mbajo: [],
      docentes: '',
      estu: '',
    };
  },
  mounted() {
    this.cargarHome();
  },
  methods: {
    cargarHome() { //traer los estudiantes
      axios.get('/api/home').then(res => {
        this.notas = res.data.notas || 0;
        this.aprob = res.data.aprobados || 0;
        this.rep = res.data.reprobados || 0;
        this.asig = res.data.asig || 0;
        this.malta = res.data.malta.materia.nombre || '';
        this.mbajo = res.data.mbajo.materia.nombre || '';
        this.docentes = res.data.docentes || 0;
        this.estu = res.data.estu || 0;
      });
    }, 
  }
};
</script>
