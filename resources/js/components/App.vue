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

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

     <router-link to="/" style="text-decoration: none">
      <v-btn icon>
        <v-icon>mdi-home</v-icon>
      </v-btn>
     </router-link>

       <v-btn icon>
        <v-icon>mdi-plus</v-icon>
      </v-btn>

    </v-app-bar>

    <v-container>
     
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