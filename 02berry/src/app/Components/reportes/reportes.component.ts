import { CommonModule, DatePipe } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterLink } from '@angular/router';
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import { IReportes } from 'src/app/Interfaces/ireportes';
import { ReportesService } from 'src/app/Services/reportes.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

@Component({
  selector: 'app-reportes',
  standalone: true,
  imports: [SharedModule, RouterLink, ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './reportes.component.html',
  styleUrl: './reportes.component.scss'
})
export class ReportesComponent implements OnInit {
  titulo: string = 'Reportes';
  btn_save: string = 'Generar reporte';
  listarDatos: IReportes[] = [];

  today: Date = new Date();
  pipe: DatePipe = new DatePipe('en-US');
  today_format: string = this.pipe.transform(this.today, 'yyyy-MM-dd HH:mm:ss') as string;
  today_format_input: string = this.pipe.transform(this.today, 'dd/MM/yyyy') as string;
  email: string = 'info@example.com';

  constructor(private ServicioReportes: ReportesService) {}
  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.ServicioReportes.todos().subscribe((datos) => (this.listarDatos = datos));
  }

  grabar() {
    const DATA: any = document.getElementById('impresion');
    html2canvas(DATA).then((canvas) => {
      const imgData = canvas.toDataURL('image/png');

      const a4Width = 180;
      const a4Height = 267;

      const imgWidth = canvas.width;
      const imgHeight = canvas.height;

      const widthRatio = a4Width / imgWidth;
      const heightRatio = a4Height / imgHeight;
      const ratio = Math.min(widthRatio, heightRatio);

      const pdfWidth = imgWidth * ratio;
      const pdfHeight = imgHeight * ratio;

      const pdf = new jsPDF('p', 'mm', 'a4');
      pdf.addImage(imgData, 'PNG', 15, 15, pdfWidth, pdfHeight);
      pdf.save('reporte_' + this.today_format + '.pdf');
    });
  }
}
