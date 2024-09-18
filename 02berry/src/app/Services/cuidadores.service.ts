import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ICuidadores } from '../Interfaces/icuidadores';

@Injectable({
  providedIn: 'root'
})
export class CuidadoresService {
  apiURL = 'http://localhost/sexto_eva2/01mvc/controllers/cuidadores.controller.php?op=';
  constructor(private http: HttpClient) {}

  todos(): Observable<ICuidadores[]> {
    return this.http.get<ICuidadores[]>(this.apiURL + 'todos');
  }

  uno(idCuidador: number): Observable<ICuidadores> {
    const formData = new FormData();
    formData.append('idCuidador', idCuidador.toString());
    return this.http.get<ICuidadores>(this.apiURL + 'uno' + formData);
  }

  insertar(cuidador: ICuidadores): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', cuidador.nombre);
    formData.append('especialidad', cuidador.especialidad);
    formData.append('telefono', cuidador.telefono);
    formData.append('email', cuidador.email);
    return this.http.post<string>(this.apiURL + 'insertar', formData);
  }

  actualizar(cuidador: ICuidadores): Observable<string> {
    const formData = new FormData();
    formData.append('idCuidador', cuidador.idCuidador.toString());
    formData.append('nombre', cuidador.nombre);
    formData.append('especialidad', cuidador.especialidad);
    formData.append('telefono', cuidador.telefono);
    formData.append('email', cuidador.email);
    return this.http.post<string>(this.apiURL + 'actualizar', formData);
  }

  eliminar(idCuidador: number): Observable<number> {
    const formData = new FormData();
    formData.append('idCuidador', idCuidador.toString());
    return this.http.post<number>(this.apiURL + 'eliminar', formData);
  }
}
