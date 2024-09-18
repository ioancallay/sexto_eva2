import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { INinios } from '../Interfaces/ininios';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
@Injectable({
  providedIn: 'root'
})
export class NiniosService {
  apiURL = 'http://localhost/sexto_eva2/01mvc/controllers/ninios.controller.php?op=';
  constructor(private http: HttpClient) {}

  todos(): Observable<INinios[]> {
    return this.http.get<INinios[]>(this.apiURL + 'todos');
  }

  uno(idNinio: number): Observable<INinios> {
    const formData = new FormData();
    formData.append('idNinio', idNinio.toString());
    return this.http.post<INinios>(this.apiURL + 'uno', formData);
  }

  insertar(ninio: INinios): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre', ninio.Nombre);
    formData.append('Apellido', ninio.Apellido);
    formData.append('Fecha_nacimiento', ninio.Fecha_nacimiento.toString());
    formData.append('Alergias', ninio.Alergias);
    formData.append('idCuidador', ninio.idCuidador.toString());
    return this.http.post<string>(this.apiURL + 'insertar', formData);
  }

  actualizar(ninio: INinios): Observable<string> {
    const formData = new FormData();
    formData.append('idNinio', ninio.idNinio.toString());
    formData.append('Nombre', ninio.Nombre);
    formData.append('Apellido', ninio.Apellido);
    formData.append('Fecha_nacimiento', ninio.Fecha_nacimiento.toString());
    formData.append('Alergias', ninio.Alergias);
    formData.append('idCuidador', ninio.idCuidador.toString());
    return this.http.post<string>(this.apiURL + 'actualizar', formData);
  }

  eliminar(idNinio: number): Observable<number> {
    const formData = new FormData();
    formData.append('idNinio', idNinio.toString());
    return this.http.post<number>(this.apiURL + 'eliminar', formData);
  }
}
