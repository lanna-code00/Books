<template>
  <v-card
    style="max-width: 100%"
    class="mx-auto"
  >

    <v-app-bar
      dark
      color="pink"
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>My Books</v-toolbar-title>

      <v-spacer></v-spacer>


     <router-link to="/" style="text-decoration: none">
      <v-btn icon>
        <v-icon>mdi-home</v-icon>
      </v-btn>
     </router-link>

     <router-link to="/create" style="text-decoration: none">
       <v-btn icon title="Add book">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
     </router-link>

    </v-app-bar>

    <v-container style="box-shadow: none; background:none">
     
      <router-view></router-view>
    </v-container>
    <!-- <router-view></router-view> -->
  </v-card>
</template>
 
<script>
export default {
    name: 'App',
   
}
</script>