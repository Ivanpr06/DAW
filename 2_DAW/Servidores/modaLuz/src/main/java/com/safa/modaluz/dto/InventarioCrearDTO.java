package com.safa.modaluz.dto;

import com.safa.modaluz.modelos.Producto;
import com.safa.modaluz.modelos.Talla;
import lombok.Data;

@Data
public class InventarioCrearDTO {

    private Integer cantidad;
    private Talla talla;
    private Producto producto;
}
