import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { IReportes } from '../Interfaces/ireportes';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ReportesService {
  apiURL = 'http://localhost/sexto_eva2/01mvc/controllers/reportes.controller.php?op=';

  constructor(private http: HttpClient) {}

  todos(): Observable<IReportes[]> {
    return this.http.get<IReportes[]>(this.apiURL + 'todos');
  }
}
