package com.safa.modaluz.dto;

import com.safa.modaluz.modelos.Color;
import com.safa.modaluz.modelos.Tipo;
import lombok.Data;

@Data
public class ProductoCrearDTO {
    private String nombre;
    private Color color;
    private Double precio;
    private Tipo tipo;
}
