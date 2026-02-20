package com.safa.modaluz.controladores;

import com.safa.modaluz.dto.ProductoPedidoCrearDTO;
import com.safa.modaluz.modelos.ProductoPedido;
import com.safa.modaluz.servicios.ProductoPedidoService;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
@RequestMapping("/productopedido")
public class ProductoPedidoController {

    @Autowired
    private ProductoPedidoService productopedidoService;

    @GetMapping("/all")
    public List<ProductoPedido> obtenerProductoPedidos(){
        return productopedidoService.bucarTodosProductoPedidos();
    }

    @GetMapping("/{id}")
    public ProductoPedido obtenerProductoPedidoPorId(@PathVariable int id){
        return productopedidoService.buscarProductoPedidoPorId(id);
    }

    @PostMapping("/post")
    public void crearProductoPedido(@RequestBody ProductoPedidoCrearDTO productopedido){
        productopedidoService.crearProductoPedido(productopedido);
    }

    @PutMapping("/editar/{id}")
    public void actualizarProductoPedido(@PathVariable Integer id, @RequestBody ProductoPedido productopedido){
        productopedidoService.editarProductoPedido(id, productopedido);
    }

    @DeleteMapping("/eliminar/{id}")
    public void eliminarProductoPedido(@PathVariable Integer id){
        productopedidoService.eliminarProductoPedido(id);
    }
}
