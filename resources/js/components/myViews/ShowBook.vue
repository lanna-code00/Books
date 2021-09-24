<template>
    <div>
         <div class="row mx-auto">
             <div class="col-md-4 mx-auto">
                  <v-card style="min-height: 530px"
            color="#385F73"
            dark
          >
            <v-card-title class="text-h5 text-center">
               <b>{{ bookDetails.name }}</b> 
            </v-card-title>

            <v-card-subtitle >
                    <div class="position-absolute top-50 start-40 text-center">
                        Author: <b>{{ bookDetails.authors }}</b>
                        <p class="mt-5">
                        ISBN: {{ bookDetails.isbn }}
                        </p>
                        <p class="mt-5">
                        PUBLISHER: {{ bookDetails.publisher }}
                        </p>
                    </div>
                    
            </v-card-subtitle>


            <v-card-actions>
              <v-btn text>
                Country: {{ bookDetails.country }}
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
    name: "ShowBook",
    data(){
        return {
            book: this.$route.params.id,
            bookDetails: {},
        }
    },

    mounted(){
        axios.get('http://localhost:8000/api/v1/book').then((response) => {
            let findBook = response.data.find((u) => u.id == this.book);
            this.bookDetails = findBook; 
            }).catch((err) => {
            console.log(err);
            
        })
    }
}
</script>