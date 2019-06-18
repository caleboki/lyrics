<template>
  <panel title="Bookmarks">
    <v-data-table
      :headers="headers"
      :pagination.sync="pagination"
      :items="bookmarks[0]">

      <template slot="items" slot-scope="props">
        <td >
          {{props.item.title}}
        </td>
        <td >
          {{props.item.artist}}

        </td>

      </template>

    </v-data-table>
  </panel>

</template>

<script>
import {mapState} from 'vuex'
import BookmarksService from '@/services/BookmarksService'

export default {

  data () {
    return {
      headers: [
        {
          text: 'Title',
          value: 'title'
        },
        {
          text: 'Artist',
          value: 'artist'
        }
      ],
      pagination: {
        sortBy: 'date',
        descending: true
      },

      bookmarks: []
      // bookmarks: [
      //   {
      //     title:'Hello',
      //     artist: 'hello'

      //   },
      //   {
      //     title:'Hello',
      //     artist: 'hello'

      //   },
      // {

      // }]
    }
  },

  computed: {
    ...mapState([
      'isUserLoggedIn',
      'user'
    ])
  },

  async mounted() {
    if (this.isUserLoggedIn) {
      this.bookmarks = (await BookmarksService.userbookmarks(this.user.id)).data

      this.bookmarks = Object.values(this.bookmarks)
      console.log('bookmark', this.bookmarks)

    }

  }

}
</script>

<style>

</style>
