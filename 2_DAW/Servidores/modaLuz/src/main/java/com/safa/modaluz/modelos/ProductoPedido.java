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
@Table(name= "producto_pedido", catalog = "postgres", schema= "moda_luz")

public class ProductoPedido {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "id")
    private Integer id;

    @Column(name="cantidad")
    private Integer cantidad;

    @ManyToOne @JoinColumn(name="id_pedido")
    private Pedido pedido;

    @ManyToOne @JoinColumn(name="id_producto")
    private Producto producto;

    @ManyToOne @JoinColumn(name="id_talla")
    private Talla talla;
}
