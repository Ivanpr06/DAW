package com.safa.modaluz.modelos;

import jakarta.persistence.*;
import lombok.*;

import java.util.HashSet;
import java.util.Set;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@ToString
@EqualsAndHashCode

@Entity
@Table(name= "producto", catalog = "postgres", schema= "moda_luz")
public class Producto {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id")
    private Integer id ;

    @Column(name="nombre")
    private String nombre;

    @Column(name="color")
    @Enumerated(EnumType.ORDINAL)
    private Color color;

    @Column(name="precio")
    private Double precio;

    @Column(name="tipo")
    @Enumerated(EnumType.ORDINAL)
    private Tipo tipo;

}
