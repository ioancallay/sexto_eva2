import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ICuidadores } from 'src/app/Interfaces/icuidadores';
import { INinios } from 'src/app/Interfaces/ininios';
import { CuidadoresService } from 'src/app/Services/cuidadores.service';
import { NiniosService } from 'src/app/Services/ninios.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevoninio',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevoninio.component.html',
  styleUrl: './nuevoninio.component.scss'
})
export class NuevoninioComponent implements OnInit {
  idNinio: number = 0;
  btn_save: string = 'Crear niño';
  btn_confirm: string = 'Crear niño';
  mensaje: string = 'Desea crear el niño ';
  titulo: string = 'Nuevo niño';
  frm_ninio: FormGroup;
  listaCuidadores: ICuidadores[] = [];

  constructor(
    private ServicioNinios: NiniosService,
    private ServicioCuidadores: CuidadoresService,
    private rutas: ActivatedRoute,
    private navegacion: Router
  ) {}

  ngOnInit(): void {
    this.cargarCuidadores();
    this.idNinio = parseInt(this.rutas.snapshot.paramMap.get('idNinio'));
    this.frm_ninio = new FormGroup({
      Nombre: new FormControl('', Validators.required),
      Apellido: new FormControl('', Validators.required),
      Fecha_nacimiento: new FormControl('', Validators.required),
      Alergias: new FormControl('', Validators.required),
      idCuidador: new FormControl('', Validators.required)
    });

    if (this.idNinio > 0) {
      this.ServicioNinios.uno(this.idNinio).subscribe((ninio) => {
        this.titulo = 'Actualizar niño';
        this.btn_save = 'Actualizar niño';
        this.btn_confirm = 'Actualizar niño!';
        this.mensaje = 'Desea actualizar el niño ';

        this.frm_ninio.controls['Nombre'].setValue(ninio.Nombre);
        this.frm_ninio.controls['Apellido'].setValue(ninio.Apellido);
        this.frm_ninio.controls['Fecha_nacimiento'].setValue(ninio.Fecha_nacimiento);
        this.frm_ninio.controls['Alergias'].setValue(ninio.Alergias);
        this.frm_ninio.controls['idCuidador'].setValue(ninio.idCuidador);
        console.log(this.frm_ninio);
      });
    }
  }

  cargarCuidadores() {
    this.ServicioCuidadores.todos().subscribe((cuidadores) => (this.listaCuidadores = cuidadores));
  }

  grabar() {
    let ninio: INinios = {
      Nombre: this.frm_ninio.get('Nombre')?.value,
      Apellido: this.frm_ninio.get('Apellido')?.value,
      Fecha_nacimiento: this.frm_ninio.get('Fecha_nacimiento')?.value,
      Alergias: this.frm_ninio.get('Alergias')?.value,
      idCuidador: this.frm_ninio.get('idCuidador')?.value
    };

    Swal.fire({
      title: 'Ninios',
      text: this.mensaje + this.frm_ninio.controls['Nombre'].value,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'green',
      cancelButtonColor: '#3085d6',
      confirmButtonText: this.btn_confirm
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idNinio > 0) {
          ninio.idNinio = this.idNinio;
          this.ServicioNinios.actualizar(ninio).subscribe((data) => {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Proceso completado',
              showConfirmButton: false,
              timer: 1500
            });
            this.navegacion.navigate(['/ninios']);
          });
        } else {
          this.ServicioNinios.insertar(ninio).subscribe((data) => {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Proceso completado',
              showConfirmButton: false,
              timer: 1500
            });
            this.navegacion.navigate(['/ninios']);
          });
        }
      }
    });
  }

  cambio(objetoSleect: any) {
    let idCuidador = objetoSleect.target.value;
    this.frm_ninio.controls['idCuidador'].setValue(idCuidador);
  }

  cambiarLetras() {
    this.frm_ninio.controls['Nombre'].setValue(this.frm_ninio.controls['Nombre'].value.toUpperCase());
    this.frm_ninio.controls['Apellido'].setValue(this.frm_ninio.controls['Apellido'].value.toUpperCase());
    this.frm_ninio.controls['Alergias'].setValue(this.frm_ninio.controls['Alergias'].value.toUpperCase());
  }
}
