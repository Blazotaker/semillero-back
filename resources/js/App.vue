<template>
  <div class="container">
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
      <a href="/" target="_blank">
        <img src="https://www.politecnicojic.edu.co/images/logo/logo.png" />
      </a>
      <br />
      <span class="text-secondary">Laravel & Vue CRUD Single Page Application (SPA) Tutorial</span>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <router-link to="/" class="nav-item nav-link">Home</router-link>
          <router-link to="/add" class="nav-item nav-link">Agregar</router-link>
          <router-link to="/Directores" class="nav-item nav-link">Directores</router-link>
        </div>
      </div>
    </nav>
    <br />
    <router-view></router-view>
  </div>
</template>

<script>
export default {};
</script>