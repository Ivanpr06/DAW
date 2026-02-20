package com.safa.modaluz.dto;

import com.safa.modaluz.modelos.Pedido;
import com.safa.modaluz.modelos.Producto;
import com.safa.modaluz.modelos.Talla;
import lombok.Data;

@Data
public class ProductoPedidoCrearDTO {

    private Integer cantidad;
    private Pedido pedido;
    private Producto producto;
    private Talla talla;
}
