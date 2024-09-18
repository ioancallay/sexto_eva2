import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { INinios } from 'src/app/Interfaces/ininios';
import { NiniosService } from 'src/app/Services/ninios.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

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
    this.ServicioNinios.todos().subscribe((data) => (this.listaNinios = data));
  }
  title: string = 'Ninios';
  listaNinios: INinios[] = [];

  eliminar(ninio_id: number) {}
}
