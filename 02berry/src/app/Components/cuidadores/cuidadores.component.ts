import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ICuidadores } from 'src/app/Interfaces/icuidadores';
import { CuidadoresService } from 'src/app/Services/cuidadores.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-cuidadores',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './cuidadores.component.html',
  styleUrl: './cuidadores.component.scss'
})
export class CuidadoresComponent implements OnInit {
  title: string = 'Cuidadores';
  listaCuidadores: ICuidadores[] = [];

  constructor(private ServcioCuidadores: CuidadoresService) {}
  ngOnInit(): void {
    this.cargarCuidadores();
  }

  cargarCuidadores() {
    this.ServcioCuidadores.todos().subscribe((cuidadores) => (this.listaCuidadores = cuidadores));
  }

  eliminar(idCuidador: number) {
    Swal.fire({
      title: 'Lista cuidadores',
      text: 'Esta seguro que desea eliminar el cuidador!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Emliminar cuidador'
    }).then((result) => {
      if (result.isConfirmed) {
        this.ServcioCuidadores.eliminar(idCuidador).subscribe((data) => {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se ha completado el trabajo',
            showConfirmButton: false,
            timer: 2000
          });
          this.cargarCuidadores();
        });
      }
    });
  }
}
