<template>
  <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
      </nav>
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <div class="container text-center">
            <img src="../../public/img/logo_nar.png" alt="Cargando imagen ..." width="60%">
        </div>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
              <router-link to="/" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Inicio</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/estudiantes" class="nav-link">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>Estudiantes</p>
              </router-link>
            </li>
             <li class="nav-item">
              <router-link to="/docentes" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>Docentes</p>
              </router-link>
            </li>
              <li class="nav-item">
              <router-link to="/asignaturas" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>Asignatura</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/notas" class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>Notas</p>
              </router-link>
            </li>
          </ul>
        </nav>
      </div>
    </aside>


    <!-- Main Content -->
    <div class="content-wrapper">
      <router-view />
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2025 <a href="#">PC</a>.</strong>
        Todos los derechos reservados
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.0
        </div>
    </footer>
  </div>
</template>
