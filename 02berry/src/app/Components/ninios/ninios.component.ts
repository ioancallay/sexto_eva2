import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { INinios } from 'src/app/Interfaces/ininios';
import { NiniosService } from 'src/app/Services/ninios.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-ninios',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './ninios.component.html',
  styleUrl: './ninios.component.scss'
})
export class NiniosComponent implements OnInit {
  constructor(private ServicioNinios: NiniosService) {}
  ngOnInit(): void {
    this.cargarNinios();
  }
  title: string = 'Ninios';
  listaNinios: INinios[] = [];

  cargarNinios() {
    this.ServicioNinios.todos().subscribe((data) => (this.listaNinios = data));
  }

  eliminar(idNinio: number) {
    Swal.fire({
      title: 'Lista Niños',
      text: 'Esta seguro que desea eliminar el niño!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Emliminar niño'
    }).then((result) => {
      if (result.isConfirmed) {
        this.ServicioNinios.eliminar(idNinio).subscribe((data) => {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se ha completado el trabajo',
            showConfirmButton: false,
            timer: 2000
          });
          this.cargarNinios();
        });
      }
    });
  }
}
