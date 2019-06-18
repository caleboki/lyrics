import Api from '@/services/Api'

export default {
  index (songId, userId) {
    return Api().get(`bookmarks/${songId}/${userId}`)
  },

  post(bookmark) {

    return Api().post('bookmarks', bookmark)
  },
  // delete(songId, userId) {
  //   return Api().delete(`bookmarks/${songId}/${userId}`)
  // }

  delete(songId, userId) {
    return Api().post('unbookmark', songId, userId)
  },

  userbookmarks(userId) {
    return Api().get(`userbookmarks/${userId}`)
  }
}
