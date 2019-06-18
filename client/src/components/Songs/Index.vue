<template>
  <v-layout>
    <v-flex xs6>
      <songs-bookmarks/>
    </v-flex>
    <v-flex xs6 class="ml-2">
      <songs-search-panel />
      <songs-panel class="mt-2"/>
    </v-flex>
  </v-layout>

</template>


<script>
import SongsService from '@/services/SongsService';
import SongsPanel from '@/components/Songs/SongsPanel';
import SongsSearchPanel from '@/components/Songs/SongsSearchPanel';
import SongsBookmarks from '@/components/Songs/SongsBookmarks';
export default {

  components: {
    SongsPanel,
    SongsSearchPanel,
    SongsBookmarks
  },

  data () {

    return {
      songs: null,
    }

  },

  async mounted() {
    this.songs = (await SongsService.index()).data.songs
    console.log(this.songs)

  },

}
</script>

<style scoped>
.song {
  padding: 20px;
  height: 330px;
  overflow: hidden;
}

.song-title {
  font-size: 30px;
}
.song-artist {
  font-size: 24px;
}
.song-genre {
  font-size: 18px;
}
.album-image {
  width: 70%;
  margin: 0 auto;
}

</style>
