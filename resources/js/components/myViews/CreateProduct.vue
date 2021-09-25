<template>
    <div>
        
            <v-card
    class="container mx-auto mt-5 mb-5"
    max-width="800"
    outlined
  >
    <h4 class="text-center m-3">CREATE BOOK</h4>
   <div class="row">
       <div class="col-md-6">
            <v-text-field
                label="Name" class="col-md-12"
                :rules="rules"
                hide-details="auto"
                v-model="editBook.name"
            ></v-text-field>
       </div>

        <div class="col-md-6">
            <v-text-field
                label="ISBN" class="col-md-12"
                :rules="rules"
                hide-details="auto"
                v-model="editBook.isbn"
            ></v-text-field>
       </div>
   </div>

   <div class="row">
       <div class="col-md-6">
            <v-text-field
                label="Author" class="col-md-12"
                :rules="rules"
                hide-details="auto"
                v-model="editBook.authors"
            ></v-text-field>
       </div>

        <div class="col-md-6">
            <v-text-field
                label="Country" class="col-md-12"
                :rules="rules"
                hide-details="auto"
                v-model="editBook.country"
            ></v-text-field>
       </div>
   </div>

   <div class="row">
       <div class="col-md-6">
            <v-text-field
                label="Pages" class="col-md-12"
                :rules="rules"
                hide-details="auto"
                v-model="editBook.number_of_pages"
            ></v-text-field>
       </div>

        <div class="col-md-6">
            <v-text-field
                label="Publisher" class="col-md-12"
                :rules="rules"
                hide-details="auto"
                v-model="editBook.publisher"
            ></v-text-field>
       </div>
   </div>

   <div class="row">
       <div class="col-md-12" data-app>
           <v-menu 
      ref="menu"
      v-model="menu"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      min-width="auto"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="date"
          label="Release Date"
          prepend-icon="mdi-calendar"
          readonly
          v-bind="attrs"
          v-on="on"
        ></v-text-field>
      </template>
      <v-date-picker
        v-model="date"
        :active-picker.sync="activePicker"
        :max="(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)"
        min="1950-01-01"
        @change="save"
      ></v-date-picker>
    </v-menu>
       </div>
   </div>

    <v-card-actions>
        <div class="row mt-2 mb-2">
            <v-btn
                outlined
                text
                class="col-md-6"
                @click="createBook()"
                color="grey darken-4"
            >
                Create
            </v-btn>

            <v-btn
                outlined
                text
                class="col-md-6"
                @click="backHome()"
            >
                Cancel
            </v-btn>


        </div>
    </v-card-actions>
  </v-card>

    </div>
</template>

<script>
import moment from "moment";
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
    name: "CreateProduct",
    data(){
        return{
            editBook: {
                name: "",
                isbn: "",
                number_of_pages: "",
                country: "",
                publisher: "",
                authors: "",
            },
            rules: [
                value => !!value || 'Required.',
                value => (value && value.length >= 3) || 'Min 3 characters',
            ],
            activePicker: null,
            date: null,
            menu: false,
        }
    },

     watch: {
      menu (val) {
        val && setTimeout(() => (this.activePicker = 'YEAR'))
      },
    },

    methods: {
        save (date) {
        this.$refs.menu.save(date)
      },

      backHome(){
     this.$router.push({ name: 'home' });
      },

            createBook() {
                let formData = new FormData();
                formData.append('name', this.editBook.name);
                formData.append('country', this.editBook.country);
                formData.append('isbn', this.editBook.isbn);
                formData.append('number_of_pages', this.editBook.number_of_pages);
                formData.append('authors', this.editBook.authors);
                formData.append('publisher', this.editBook.publisher);
                formData.append('release_date', this.date);
           
               axios.post(`http://localhost:8000/api/v1/book`, formData)
                    .then((res) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Created',
                            text: 'New book has been created',
                        })
                        this.$router.push({ name: 'home' });
                    }).catch(() => {
                          Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                         })
                    });
            }
    }
}
</script>