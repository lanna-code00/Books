<template>
  <v-card
    class="container mx-auto mt-5 mb-5"
    max-width="800"
    outlined
  >
    <h4 class="text-center m-3">EDIT BOOK</h4>
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
                class="col-md-6 "
                @click="updateBook()"
            >
                Save
            </v-btn>

            <v-btn
                outlined
                text
                class="col-md-6"
            >
                Cancel
            </v-btn>

        </div>
    </v-card-actions>
  </v-card>
</template>

<script>
import moment from "moment";
import Swal from 'sweetalert2';

export default {
   name: "EditProduct",
   data() {
       return {
            book: this.$route.params.id,
            editBook: {},
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

      editProduct(productId) {
                axios.get(`http://localhost:8000/api/v1/book/${this.book}`)
                   .then((res) => {
                       this.editBook = res.data;
                       this.date = moment(String(this.editBook.release_date)).format('YYYY-MM-DD')
                   }).catch((err) => console.log(err));
            },

      updateBook() {
             let newBook = {
                    name: this.editBook.name,
                    country: this.editBook.country,
                    isbn: this.editBook.isbn,
                    pages: this.editBook.number_of_pages,
                    author: this.editBook.authors,
                    publisher: this.editBook.publisher,
                    release_date: this.date
                }
            axios.put(`http://localhost:8000/api/v1/book/${this.book}`, newBook)
                    .then((res) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Your data has been successfully updated',
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

   },

    mounted() {
            this.editProduct(this.book);
        },

//    created(){
//       axios.get('http://localhost:8000/api/v1/book').then((response) => {
//             let findBook = response.data.find((u) => u.id == this.book);
//             if (findBook) {
//                 this.editBook = {
//                     name: findBook.name,
//                     country: findBook.country,
//                     isbn: findBook.isbn,
//                     pages: findBook.number_of_pages,
//                     author: findBook.authors,
//                     publisher: findBook.publisher,
//                     release_date: moment(String(findBook.release_date)).format('YYYY-MM-DD')
//                 }
//             }
//             }).catch((err) => {
//             console.log(err);
            
//         })
//    }
}
</script>