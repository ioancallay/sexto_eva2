import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';

@Component({
  selector: 'app-nuevoninio',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevoninio.component.html',
  styleUrl: './nuevoninio.component.scss'
})
export class NuevoninioComponent implements OnInit {
  // }<!-- idNinio
  // nombre
  // apellido
  // fecha_nacimiento
  // alergias -->
  // title: string = 'Nuevo Niño';
  // btn_save: string = 'Guardar';
  // frm_ninio: FormGroup;

  ngOnInit(): void {
    this.frm_ninio = new FormGroup({
      Nombre: new FormControl('', Validators.required),
      Apellido: new FormControl('', Validators.required),
      Fecha_nacimiento: new FormControl('', Validators.required),
      Alergias: new FormControl('', Validators.required)
    });
  }

  title: string = 'Nuevo Niño';
  btn_save: string = 'Guardar';
  frm_ninio: FormGroup;

  grabar() {}
}
