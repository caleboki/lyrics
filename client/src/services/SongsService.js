import Api from '@/services/Api'

export default {
  // index(search) {
  //   return Api().get('songs', {
  //     params: {
  //       search: search
  //     }
  //   })
  // },

  index(search) {

    if (search === undefined) {
      return Api().get('songs')
    }
    return Api().get(`songs/${search}`)
  },

  post(song) {
    return Api().post('songs', song)
  },

  show(songId) {
    return Api().get(`song/${songId}`)
  },

  put(song) {
    console.log(song.song.id)
    return Api().put(`songs/${song.song.id}`, song)
  },
}
