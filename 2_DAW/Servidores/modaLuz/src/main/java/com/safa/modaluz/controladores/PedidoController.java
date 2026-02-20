package com.safa.modaluz.controladores;

import com.safa.modaluz.dto.ClienteCrearDTO;
import com.safa.modaluz.dto.PedidoCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.modelos.Pedido;
import com.safa.modaluz.servicios.ClienteService;
import com.safa.modaluz.servicios.PedidoService;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
@RequestMapping("/pedido")
public class PedidoController {

    @Autowired
    private PedidoService pedidoService;

    @GetMapping("/all")
    public List<Pedido> obtenerPedidos(){
        return pedidoService.bucarTodosPedidos();
    }

    @GetMapping("/{id}")
    public Pedido obtenerPedidoPorId(@PathVariable int id){
        return pedidoService.buscarPedidoPorId(id);
    }

    @PostMapping("/post")
    public void crearPedido(@RequestBody PedidoCrearDTO cliente){
        pedidoService.crearPedido(cliente);
    }

    @PutMapping("/editar/{id}")
    public void actualizarPedido(@PathVariable Integer id, @RequestBody Pedido pedido){
        pedidoService.editarPedido(id, pedido);
    }

    @DeleteMapping("/eliminar/{id}")
    public void eliminarPedido(@PathVariable Integer id){
        pedidoService.eliminarPedido(id);
    }
}
