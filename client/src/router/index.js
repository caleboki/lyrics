import Vue from 'vue'
import Router from 'vue-router'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Songs from '@/components/Songs/Index'
import CreateSong from '@/components/CreateSong'
import ViewSong from '@/components/ViewSong/Index'
import EditSong from '@/components/EditSong'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      redirect: 'Songs'
    },

    {
      path: '/register',
      name: 'Register',
      component: Register
    },

    {
      path: '/login',
      name: 'Login',
      component: Login
    },

    {
      path: '/songs',
      name: 'Songs',
      component: Songs
    },

    {
      path: '/song/create',
      name: 'song-create',
      component: CreateSong
    },

    {
      path: '/song/:songId',
      name: 'view-song',
      component: ViewSong
    },

    {
      path: '/song/:songId/edit',
      name: 'edit-song',
      component: EditSong
    }
  ]
})
