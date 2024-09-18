import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ICuidadores } from 'src/app/Interfaces/icuidadores';
import { CuidadoresService } from 'src/app/Services/cuidadores.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevocuidador',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule, FormsModule],
  templateUrl: './nuevocuidador.component.html',
  styleUrl: './nuevocuidador.component.scss'
})
export class NuevocuidadorComponent implements OnInit {
  idCuidador: number = 0;
  btn_save: string = 'Crear cuidador';
  btn_confirm: string = 'Crear cuidador';
  mensaje: string = 'Desea crear el cuidador';
  titulo: string = 'Nuevo cuidador';
  frm_cuidador: FormGroup;

  constructor(
    private ServicioCuidadores: CuidadoresService,
    private rutas: ActivatedRoute,
    private navegacion: Router
  ) {}

  ngOnInit(): void {
    this.idCuidador = parseInt(this.rutas.snapshot.paramMap.get('idCuidador'));
    console.log(this.idCuidador);
    this.frm_cuidador = new FormGroup({
      Nombre: new FormControl('', Validators.required),
      Especialidad: new FormControl('', Validators.required),
      Telefono: new FormControl('', Validators.required),
      Email: new FormControl('', Validators.required)
    });

    if (this.idCuidador > 0) {
      console.log(this.idCuidador);
      this.ServicioCuidadores.uno(this.idCuidador).subscribe((cuidador) => {
        this.titulo = 'Actualizar Cuidador';
        this.btn_save = 'Actualizar cuidador';
        this.btn_confirm = 'Actualizar cuidador!';
        this.mensaje = 'Desea actualizar el cuidador';

        this.frm_cuidador.controls['Nombre'].setValue(cuidador.Nombre);
        this.frm_cuidador.controls['Especialidad'].setValue(cuidador.Especialidad);
        this.frm_cuidador.controls['Telefono'].setValue(cuidador.Telefono);
        this.frm_cuidador.controls['Email'].setValue(cuidador.Email);
        console.log(this.frm_cuidador);

        // this.ServicioCuidadores.uno(this.idCuidador).subscribe((unCuidador) => {
        //   this.frm_cuidador.controls['Nombre'].setValue(unCuidador.Nombre);
        //   this.frm_cuidador.controls['Especialidad'].setValue(unCuidador.Especialidad);
        //   this.frm_cuidador.controls['Telefono'].setValue(unCuidador.Telefono);
        //   this.frm_cuidador.controls['Email'].setValue(unCuidador.Email);
        // });
      });
      console.log(this.frm_cuidador);
    }
  }

  grabar() {
    let cuidador: ICuidadores = {
      Nombre: this.frm_cuidador.get('Nombre')?.value,
      Especialidad: this.frm_cuidador.get('Especialidad')?.value,
      Telefono: this.frm_cuidador.get('Telefono')?.value,
      Email: this.frm_cuidador.get('Email')?.value
    };
    console.log(cuidador);
    Swal.fire({
      title: 'Cuidadores',
      text: this.mensaje + this.frm_cuidador.controls['Nombre'].value,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: 'red',
      cancelButtonColor: '#3085d6',
      confirmButtonText: this.btn_confirm
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idCuidador > 0) {
          cuidador.idCuidador = this.idCuidador;
          this.ServicioCuidadores.actualizar(cuidador).subscribe((data) => {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Proceso completado',
              showConfirmButton: false,
              timer: 1000
            });
            this.navegacion.navigate(['/cuidadores']);
          });
        } else {
          this.ServicioCuidadores.insertar(cuidador).subscribe((data) => {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Proceso completado',
              showConfirmButton: false,
              timer: 1000
            });
            this.navegacion.navigate(['/cuidadores']);
          });
        }
      }
    });
  }
}
