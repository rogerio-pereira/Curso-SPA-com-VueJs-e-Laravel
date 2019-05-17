<template>
  <span>
    <header>
      <navbar cor='green darken-1' logo='Social' url='/' />
    </header>

    <main>
      <div class='container'>
        <router-view/>
      </div>
    </main>

    <footer-vue cor='green darken-1' logo='Social' descricao='Teste de Descrição' >
      <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
    </footer-vue>
  </span>
</template>

<script>
import Navbar from '@/components/layouts/Navbar'
import FooterVue from '@/components/layouts/FooterVue'

export default {
  name: 'App',
  components: {
    Navbar,
    FooterVue
  },
}
</script>

<style>
</style>
