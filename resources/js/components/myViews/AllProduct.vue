<template>
    <div>
                 <div class="row" dense>
        <div class="col-md-4 p-1" v-for="(book, i) in allbooks" :key="i">
          <v-card
            :style="{backgroundColor: randomColor}"
            color="#385F73"
            dark
          >
            <v-card-title class="text-h5">
              {{ book.name }}
            </v-card-title>

            <v-card-subtitle>{{book.number_of_pages}} Pages</v-card-subtitle>

            <v-card-actions>
              <v-btn text>
                 {{ book.authors }}
              </v-btn>

                  <v-spacer></v-spacer>

            <router-link :to="{name: 'show', params: {id: book.id}}" style="text-decoration: none">
                <v-btn icon title="View">
                    <v-icon>mdi-eye</v-icon>
                </v-btn>
            </router-link>

              <!-- <v-btn icon title="View" @click="viewBook(book.id)">
                <v-icon>mdi-eye</v-icon>
              </v-btn> -->

             <router-link :to="{name: 'edit', params: {id: book.id}}" style="text-decoration: none">
              <v-btn icon title="Edit">
                <v-icon>mdi-lead-pencil</v-icon>
              </v-btn>
             </router-link>

              <v-btn icon title="Delete">
                <v-icon>mdi-delete-variant</v-icon>
              </v-btn>

            </v-card-actions>
          </v-card>
        </div>

      </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AllProduct',
    data(){
        return {
            allbooks: [],
            randomColor: '#'+Math.floor(Math.random()*16777215).toString(16)
        }
    },

    methods: {
            // function for viewing books
         viewBook (id) {
             if(this.allbooks.length < 1){
                return
             } else {
                 let filteredBook = this.allbooks.find((u) => u.id == id);
                 console.log(filteredBook);
                 this.$router.push({ name: '/show', params: { filteredBook } }).catch(()=>{})
                //  this.$router.push("/path");
             }
        }   
    },

    mounted(){
        axios.get(`http://localhost:8000/api/v1/book`).then((response) => {
            this.allbooks = response.data;
        }).catch((err) => console.log(err));

        setTimeout(() => {
            this.randomColor;
        }, 2000);
    }

}
</script>