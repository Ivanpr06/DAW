package com.safa.modaluz.modelos;

import jakarta.persistence.*;
import lombok.*;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@ToString
@EqualsAndHashCode

@Entity
@Table(name= "pedido", catalog = "postgres", schema= "moda_luz")
public class Pedido {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id")
    private Integer id;

    @Column(name="precio")
    private Double precio;

    @Column(name="fecha")
    private Date fecha;

    @ManyToOne @JoinColumn(name="id_cliente")
    private Cliente cliente;
}