<template>
    <nav :class='cor || "blue"'>
        <div class="nav-wrapper container">
            <a :href="url || '#/'" class="brand-logo">{{logo || 'Site'}}</a>
            
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <slot />
            </ul>
        </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  props:[
      'logo',
      'url',
      'cor'
  ],
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
