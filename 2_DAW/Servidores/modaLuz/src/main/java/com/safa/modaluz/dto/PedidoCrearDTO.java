package com.safa.modaluz.dto;

import com.safa.modaluz.modelos.Cliente;
import lombok.Data;

import java.util.Date;

@Data
public class PedidoCrearDTO {
    private Double precio;
    private Date fecha;
    private Cliente cliente;
}
