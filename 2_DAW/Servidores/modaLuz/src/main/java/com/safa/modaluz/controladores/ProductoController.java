package com.safa.modaluz.controladores;

import com.safa.modaluz.dto.ClienteCrearDTO;
import com.safa.modaluz.dto.ProductoCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.modelos.Producto;
import com.safa.modaluz.servicios.ClienteService;
import com.safa.modaluz.servicios.ProductoService;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
@RequestMapping("/producto")
public class ProductoController {

    @Autowired
    private ProductoService productoService;

    @GetMapping("/all")
    public List<Producto> obtenerProductos(){
        return productoService.bucarTodosProductos();
    }

    @GetMapping("/{id}")
    public Producto obtenerProductoPorId(@PathVariable int id){
        return productoService.buscarProductoPorId(id);
    }

    @PostMapping("/post")
    public void crearProducto(@RequestBody ProductoCrearDTO producto){
        productoService.crearProducto(producto);
    }

    @PutMapping("/editar/{id}")
    public void actualizarProducto(@PathVariable Integer id, @RequestBody Producto producto){
        productoService.editarProducto(id, producto);
    }

    @DeleteMapping("/eliminar/{id}")
    public void eliminarProducto(@PathVariable Integer id){
        productoService.eliminarProducto(id);
    }
}
