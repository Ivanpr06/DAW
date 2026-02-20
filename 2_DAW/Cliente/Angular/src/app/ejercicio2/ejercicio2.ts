import { Component } from '@angular/core';
import {dateTimestampProvider} from 'rxjs/internal/scheduler/dateTimestampProvider';

@Component({
  selector: 'app-ejercicio2',
  imports: [],
  templateUrl: './ejercicio2.html',
  styleUrl: './ejercicio2.css',
})
export class Ejercicio2 {
  horaActual: string = '';
  private intervalo: any;
  estaActivo: boolean = true;

  ngOnInit(): void {
    this.iniciarReloj();
  }

  actualizarHora(): void {
    const ahora = new Date();
    this.horaActual = this.formatearHora(ahora);
  }

  formatearHora(fecha: Date): string {
    const horas = fecha.getHours().toString().padStart(2, '0');
    const minutos = fecha.getMinutes().toString().padStart(2, '0');
    const segundos = fecha.getSeconds().toString().padStart(2, '0');

    return `${horas}:${minutos}:${segundos}`;
  }

  iniciarReloj(): void {
    this.actualizarHora(); // Mostrar hora inmediatamente
    this.intervalo = setInterval(() => {
      this.actualizarHora();
    }, 1000);
    this.estaActivo = true;
  }

  detenerReloj(): void {
    if (this.intervalo) {
      clearInterval(this.intervalo);
      this.intervalo = null;
    }
    this.estaActivo = false;
  }

  toggleReloj(): void {
    if (this.estaActivo) {
      this.detenerReloj();
    } else {
      this.iniciarReloj();
    }
  }

  ngOnDestroy(): void {
    if (this.intervalo) {
      clearInterval(this.intervalo);
    }
  }
}
