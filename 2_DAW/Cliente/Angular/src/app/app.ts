import { Component, signal } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import {Ejercicio1} from './ejercicio1/ejercicio1';
import {Ejercicio2} from './ejercicio2/ejercicio2';
import {Ejercicio3} from './ejercicio3/ejercicio3';

@Component({
  selector: 'app-root',
  imports: [RouterOutlet, Ejercicio1, Ejercicio2, Ejercicio3],
  templateUrl: './app.html',
  styleUrl: './app.css'
})

export class App {
  protected readonly title = signal('Angular');

  nombreEj1:string = 'Iván'
}
