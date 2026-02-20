package com.safa.modaluz.modelos;

import jakarta.persistence.*;
import lombok.*;
@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@ToString
@EqualsAndHashCode

@Entity
@Table(name= "inventario", catalog = "postgres", schema= "moda_luz")

public class Inventario {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id")
    private Integer id ;

    @Column(name="cantidad")
    private Integer cantidad;

    @ManyToOne @JoinColumn(name="id_talla")
    private Talla talla;

    @ManyToOne @JoinColumn(name="id_producto")
    private Producto producto;

}
