import Home from '../views/Home'
import Karyawan from '../views/Karyawan'
import Tim from '../views/Tim'
import Unit from '../views/Unit'
import Kriteria from '../views/Kriteria'
import KategoriHasil from '../views/KategoriHasil'
import Nilai from '../views/Nilai'

export default
{
    mode:'history',
    linkActiveClass:'active',
    routes: [
        {
            path:'/',
            name:'home',
            component: Home,
        },
        {
            path:'/karyawan',
            name:'karyawan',
            component: Karyawan,
        },
        {
            path:'/tim',
            name:'tim',
            component: Tim,
        },
        {
            path:'/unit',
            name:'unit',
            component: Unit,
        },
        {
            path:'/kriteria',
            name:'kriteria',
            component: Kriteria,
        },
        {
            path:'/kategori_hasil',
            name:'kategori_hasil',
            component: KategoriHasil,
        },
        {
            path:'/nilai',
            name:'nilai',
            component: Nilai,
        },
    ]
}