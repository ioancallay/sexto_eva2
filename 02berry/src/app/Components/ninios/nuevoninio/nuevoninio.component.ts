import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NiniosService } from 'src/app/Services/ninios.service';

@Component({
  selector: 'app-nuevoninio',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevoninio.component.html',
  styleUrl: './nuevoninio.component.scss'
})
export class NuevoninioComponent implements OnInit {
  idNinio: number = 0;
  btn_save: string = 'Crear cuidador';
  btn_confirm: string = 'Crear cuidador';
  mensaje: string = 'Desea crear el cuidador';
  titulo: string = 'Nuevo cuidador';
  frm_ninio: FormGroup;

  constructor(
    private ServicioNinios: NiniosService,
    private rutas: ActivatedRoute,
    private navegacion: Router
  ) {}

  ngOnInit(): void {
    this.frm_ninio = new FormGroup({
      Nombre: new FormControl('', Validators.required),
      Apellido: new FormControl('', Validators.required),
      Fecha_nacimiento: new FormControl('', Validators.required),
      Alergias: new FormControl('', Validators.required)
    });
  }

  grabar() {}
}
