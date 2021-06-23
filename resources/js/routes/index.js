import Home from '../views/Home'
import Karyawan from '../views/Karyawan'
import Tim from '../views/Tim'
import Unit from '../views/Unit'
import Kriteria from '../views/Kriteria'
import KategoriHasil from '../views/KategoriHasil'
import Nilai from '../views/Nilai'
import TimDetail from '../views/TimDetail'
import UnitDetail from '../views/UnitDetail'
import Penilaian from '../views/Penilaian'
import PenilaianCreate from '../views/Penilaian/Create'
import PenilaianDetail from '../views/PenilaianDetail'

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
        {
            path:'/tim_detail',
            name:'tim_detail',
            component: TimDetail,
        },
        {
            path:'/unit_detail',
            name:'unit_detail',
            component: UnitDetail,
        },
        {
            path:'/penilaian',
            name:'penilaian',
            component: Penilaian,
        },
        {
            path:'/penilaian/create',
            name:'penilaian.create',
            component: PenilaianCreate,
        },
        {
            path:'/penilaian_detail',
            name:'penilaian_detail',
            component: PenilaianDetail,
        },
    ]
}