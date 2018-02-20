<template>
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
</template>

<script>
export default {
    props: ['categories'],

  }


</script>
