import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ICuidadores } from 'src/app/Interfaces/icuidadores';
import { CuidadoresService } from 'src/app/Services/cuidadores.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

@Component({
  selector: 'app-cuidadores',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './cuidadores.component.html',
  styleUrl: './cuidadores.component.scss'
})
export class CuidadoresComponent {
  title: string = 'Cuidadores';
  listaCuidadores: ICuidadores[] = [];

  constructor(ServcioCuidadores: CuidadoresService) {}

  eliminar(idCuidador: number) {}
}
