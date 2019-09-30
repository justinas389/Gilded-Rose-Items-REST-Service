<template>
    <div>
      <h2>Items</h2>
      <form @submit.prevent="addItem" class="mb-3">
        <div class="form-group">
          <input class="form-control" type="text" name="" value="" placeholder="Title" v-model="item.title">
        </div>
        <div class="form-group">
          <input class="form-control" type="number" name="" value="" placeholder="Quality" v-model="item.quality">
          </div>
        <div class="form-group">
          <input class="form-control" type="number" name="" value="" placeholder="Sell in" v-model="item.sell_in">
          </div>
        <div class="form-group">
        <button type="submit" class="btn btn-light btn-block">Save</button>
        </div>
      </form>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.prev_page_url)">Previous</a></li>
          <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page}} of {{ pagination.last_page}}</a></li>
          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchItems(pagination.next_page_url)">Next</a></li>
        </ul>
      </nav>
      <div class="card card-body mb-2" v-for="item in items" v-bind:key="item.id">
        <p>Title: {{ item.title}}</p>
        <p>Quality: {{ item.quality}}</p>
        <p>Sell In: {{ item.sell_in}}</p>
        <p>
          <button @click="editItem(item)" class="btn mb-2 btn-warning" type="button" name="button">Edit</button>
          <button @click="deleteItem(item.id)" class="btn mb-2 btn-danger" type="button" name="button">Delete</button>
        </p>
      </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        items: [],
        item: {
          id: '',
          title: '',
          quality: '',
          sell_in: ''
        },
        item_id:'',
        pagination: {},
        edit: false
      }
    },

    created() {
      this.fetchItems();
    },

    methods: {
      fetchItems(page_url){
        let vm = this;
        page_url = page_url || 'api/items'
        fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.items = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => concole.log(err));
      },
      makePagination(meta, links) {
        let pagination = {
          current_page: meta.current_page,
          last_page: meta.last_page,
          next_page_url: links.next,
          prev_page_url: links.prev,
        }

        this.pagination = pagination;
      },
      deleteItem(id) {
        if(confirm('Are you Sure?')) {
          fetch(`api/item/${id}`, {
            method: 'delete'
          })
          .then(res => res.json())
          .then(data => {
            alert('Item Removed');
            this.fetchItems();
          })
          .catch(err => console.log(err));
        }
      },
      addItem() {
        if(this.edit === false) {
          // Add
          fetch('api/item', {
            method: 'post',
            body: JSON.stringify(this.item),
            headers: {
              'content-type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.item.title = '',
            this.item.quality = '',
            this.item.sell_in = ''
            alert('Item Added');
            this.fetchItems();
          })
          .catch(err => concole.log(err));
        } else {
          // Update
          fetch('api/item', {
            method: 'put',
            body: JSON.stringify(this.item),
            headers: {
              'content-type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.item.title = '',
            this.item.quality = '',
            this.item.sell_in = ''
            alert('Item Updated');
            this.fetchItems();
          })
          .catch(err => concole.log(err));
        }
      },
      editItem(item) {
        this.edit = true;
        this.item.id = item.id;
        this.item.item_id = item.id;
        this.item.title = item.title;
        this.item.quality = item.quality;
        this.item.sell_in = item.sell_in;


      }
    }
  }
</script>
