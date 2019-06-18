<template>
<div>
  <v-layout>
    <v-flex xs6>
      <song-metadata :song="song" />
    </v-flex>

    <v-flex xs6 class="ml-2">
      <you-tube :youtubeId="song.youtubeId"/>
    </v-flex>
  </v-layout>


  <v-layout class="mt-2">

    <v-flex xs6 class="ml-2 ">
      <!-- <panel title="Song Metadata">YouTube Video</panel> -->
      <tab :song="song"/>
    </v-flex>

    <v-flex xs6 class="ml-2 ">
      <lyrics :song="song"/>

    </v-flex>
  </v-layout>
</div>

</template>

<script>
import SongMetadata from '@/components/ViewSong/SongMetadata';
import SongsService from '@/services/SongsService';
import YouTube from '@/components/ViewSong/YouTube';
import Lyrics from '@/components/ViewSong/Lyrics';
import Tab from '@/components/ViewSong/Tab';

export default {

  data () {
    return {
      song: null
    }
  },

  async mounted () {
    const songId = this.$store.state.route.params.songId
    this.song = (await SongsService.show(songId)).data.song
  },

  components: {
    SongMetadata,
    YouTube,
    Lyrics,
    Tab
  }

}
</script>


<style scoped>


</style>
