export interface IReportes {
  asignacion_id?: number;
  idNinio?: number;
  idCuidador?: number;
  Motivo?: string;
  Fecha_asignacion?: string;

  //Campos de la tabla niños
  NombreNinio?: string;
  Fecha_nacimiento?: string;
  Alergias?: string;

  //Campos de la tabla cuidadores
  NombreCuidador?: string;
  Especialidad?: string;
  Telefono?: string;
  Email?: string;
}
