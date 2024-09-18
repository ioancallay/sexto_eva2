import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AdminComponent } from './theme/layout/admin/admin.component';
import { GuestComponent } from './theme/layout/guest/guest.component';

const routes: Routes = [
  {
    path: '',
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: '/default',
        pathMatch: 'full'
      },
      {
        path: 'default',
        loadComponent: () => import('./demo/default/default.component').then((c) => c.DefaultComponent)
      },
      {
        path: 'cuidadores',
        loadComponent: () => import('./Components/cuidadores/cuidadores.component').then((c) => c.CuidadoresComponent)
      },
      {
        path: 'nuevocuidador',
        loadComponent: () => import('./Components/cuidadores/nuevocuidador/nuevocuidador.component').then((c) => c.NuevocuidadorComponent)
      },
      {
        path: 'editarcuidador/:idCuidador',
        loadComponent: () => import('./Components/cuidadores/nuevocuidador/nuevocuidador.component').then((c) => c.NuevocuidadorComponent)
      },
      {
        path: 'ninios',
        loadComponent: () => import('./Components/ninios/ninios.component').then((c) => c.NiniosComponent)
      },
      {
        path: 'nuevoninio',
        loadComponent: () => import('./Components/ninios/nuevoninio/nuevoninio.component').then((c) => c.NuevoninioComponent)
      },
      {
        path: 'editarninio/:idNinio',
        loadComponent: () => import('./Components/ninios/nuevoninio/nuevoninio.component').then((c) => c.NuevoninioComponent)
      },
      {
        path: 'reportes',
        loadComponent: () => import('./Components/reportes/reportes.component').then((c) => c.ReportesComponent)
      }
    ]
  },
  {
    path: '',
    component: GuestComponent,
    children: [
      {
        path: 'guest',
        loadChildren: () => import('./demo/pages/authentication/authentication.module').then((m) => m.AuthenticationModule)
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
