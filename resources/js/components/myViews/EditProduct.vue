<template>
    <div>
         
    </div>
</template>

<script>
export default {
   name: "EditProduct",
   data() {
       return {
            book: this.$route.params.id,
            editBook: {},
       }
   },

   mounted(){
      axios.get('http://localhost:8000/api/v1/book').then((response) => {
            let findBook = response.data.find((u) => u.id == this.book);
            this.editBook = findBook; 
            }).catch((err) => {
            console.log(err);
            
        })
   }
}
</script>