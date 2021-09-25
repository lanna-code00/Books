<template>
    <div>
      <div class="row mx-auto">
        <div class="col-md-9">
         <h3 class="text-center m-3 col-md-12">LIBRARY</h3>
        </div>
        <div class="col-md-3 float-end mt-4">
          <div class="input-group">
          <input type="text" v-model="searchBooks" class="form-control" placeholder="Search books..." aria-label="Recipient's username" aria-describedby="basic-addon2">
          <span class="input-group-text" style="height: 37px" id="basic-addon2">
             <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
          </span>
        </div>
        </div>
      </div>
                 <div class="row" dense>
        <div class="col-md-4 p-1" v-for="(book, i) in filteredNames" :key="i">
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

              <v-btn icon title="Delete" @click="displayDeleteModal(book.id)" data-toggle="modal" data-target="#exampleModalCenter">
                <v-icon>mdi-delete-variant</v-icon>
              </v-btn>

            </v-card-actions>
          </v-card>
        </div>

      </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <p id="deleteMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteBook(deleteId)">Delete</button>
      </div>
    </div>
  </div>
</div>

    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: 'AllProduct',
    data(){
        return {
            allbooks: [],
            deleteId: "",
            randomColor: '#'+Math.floor(Math.random()*16777215).toString(16),
            searchBooks: ""
        }
    },

    computed: {
    filteredList() {
      return this.allbooks.filter(post => {
        return post.name.toLowerCase().includes(this.searchBooks.toLowerCase())
      })
    },
    filteredNames() {
    let filter = new RegExp(this.searchBooks, 'i');
    return this.allbooks.filter(el => el.name.match(filter) || el.country.match(filter) || el.publisher.match(filter) || el.release_date.match(filter))
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
        },

        displayDeleteModal(id) {
            this.deleteId = id;
            let filteredBook = this.allbooks.find((u) => u.id == id);
            deleteMessage.innerHTML = `Are you sure you want to delete <b class="text-danger">${filteredBook.name} ?</b>`;
        },
        
        deleteBook(id){
            let filteredBook = this.allbooks.find((u) => u.id == id);
          
            axios.delete(`http://localhost:8000/api/v1/book/${filteredBook.id}`).then((response) => {
                  Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: `Item deleted successfully`,
                    })
                  this.$router.push({ name: 'home' });
            }).catch(() => {
               Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Data not deleted',
                         })
            })
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