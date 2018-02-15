<template>
<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-7 col-md-offset-2">
        <h1 class="text-center">Add categories</h1><br>
        <form method="post" v-on:submit.prevent="addCategory()">
          <div class="form-group" v-bind:class="{ 'has-error': test()}">
            <label for="category">Category:</label>
            <input type="text" class="form-control Error" id="category" name="category" v-model="category.category" placeholder="Enter category" value="">
            <input type="hidden" class="form-control Error" id="user_id" name="user_id" v-model="category.user_id" value="">
            <span class="help-block">
               <strong v-for="error in errors">{{ error.category[0] }}</strong><br>
            </span>
          </div>
          <button class="btn btn-primary col-md-12" aria-label="Left Align">Add category</button>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 col-md-offset-2">
        <table>
          <tr v-for="category in categories[0]">
            <td>
              {{ category.category }}
            </td>
            <td>{{ category.user_id }}</td>
            <td><a href="#" v-on:click.prevent="editCategory(category)">edit</a></td>
            <td><a href="#" v-on:click.prevent="removeCategory(category)">remove</a></td>

          </tr>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <modal v-if="showModal">
   <h3 slot="header" class="modal-title">
     Modal title22
   </h3>

   <div slot="body">
     <!-- <img src="./assets/logo.png" /> -->
     <form method="post" v-on:submit.prevent="addCategory()">
       <div class="form-group" v-bind:class="{ 'has-error': test()}">
         <label for="category">Category:</label>
         <input type="text" class="form-control Error" id="category" name="category" v-model="edit_category.category" placeholder="Enter category">
         <input type="hidden" class="form-control Error" id="category_id" name="category_id" v-model="edit_category.category_id">
         <span class="help-block">
            <strong v-for="error in errors">{{ error.category[0] }}</strong><br>
         </span>
       </div>
     </form>
   </div>

   <div slot="footer">
    <button type="button" class="btn btn-outline-info" @click="closeModal()"> Close </button>
    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateCategory()">
      Update
    </button>
   </div>
  </modal>

</div>


</template>

<script>
import Modal from './Modal';

    export default {
        components: {
          Modal
        },
        data() {
          return {
              category: {
                  category: '',
                  user_id: '',
              },
              edit_category: {
                  category_id: '',
                  category: '',
                  user_id: '',
              },
              categories: [],
              errors: [],
              isActive: false,
              showModal: false
          }
        },
        created () {
          this.getUserId();
          this.getCategory();

        },
        mounted() {
            console.log('Component mounted.')
            console.log();
        },
        methods: {
            openModal() {
              this.showModal = true;
              console.log("showModal: " + this.showModal)
            } ,
           closeModal() {
              this.showModal = false;
           },

            addCategory(){
              this.errors = [];

              axios.post('/category', {
                  category: this.category.category,
                    user_id: this.category.user_id,
                    csrf_token: $('meta[name="csrf-token"]').attr('content'),
              })
              .then( response => {
                  this.reset();
                  this.getCategory();
                  console.log("Добавили!");
              })
              .catch( e => {
                this.errors.push(e.response.data.errors);
                console.log("ADD")
                console.log(e.response.data.errors)
                console.log("")
              })

            },

            updateCategory(){
              this.errors = [];

              axios.put('/category/' + this.edit_category.category_id, {
                    category: this.edit_category.category,
                    csrf_token: $('meta[name="csrf-token"]').attr('content'),
              })
              .then( response => {
                  this.reset();
                  this.getCategory();
                  console.log("Обновили!");
              })
              .catch( e => {
                this.errors.push(e.response.data.errors);
                console.log(e.response.data.errors)
              })
            },

            getCategory(){
              console.log("getCategory");
              this.categories = [];
              axios.get('/categories', {

              })
              .then( response => {
                  console.log(response);
                  this.categories.push(response.data);
              })
              .catch( e => {
                console.log("Don't get categories!");
              })
            },
            removeCategory(category){
              console.log("removeCategory TEST");
              console.log("removeCategory", category.id);
              axios.delete('/category/' + category.id,{
              })
              .then( response => {
                this.getCategory();
              })
              .catch( e => {
                console.log("You didn't delete category");
              })
            },

            getUserId(){
              let self = this;
              axios.get('/session/get_user_id',{

              })
              .then( function(response)  {
                self.category.user_id = response.data.user_id;
              })
            },

            reset()
            {
                this.category.category = '';
            },

            test(){

              if(typeof this.errors[0] === "undefined"){

                return false;
              }
              console.log(this.errors[0]);
              if(typeof this.errors[0].category === "undefined"){
                return false;
              }
              //console.log(this.errors[0].data);
              if(typeof this.errors[0].category[0] === "undefined"){
                return false;
              }

              return true;
            },

            editCategory(category){
              console.log(category.category);
              this.edit_category.category_id = category.id;
              this.edit_category.category = category.category;
              this.openModal();
            }
        }
    }
</script>
<style>
#wrapper {
  margin-top: 60px;
}
</style>
